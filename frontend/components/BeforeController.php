<?php


namespace frontend\components;

use yii\base\Exception;
use yii\base\InlineAction;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\ServerErrorHttpException;
use Yii;

class BeforeController extends Controller
{
    /**
     * Binds the parameters to the action.
     * This method is invoked by [[\yii\base\Action]] when it begins to run with the given parameters.
     * This method will check the parameter names that the action requires and return
     * the provided parameters according to the requirement. If there is any missing parameter,
     * an exception will be thrown.
     * @param \yii\base\Action $action the action to be bound with parameters
     * @param array $params the parameters to be bound to the action
     * @return array the valid parameters that the action can run with.
     * @throws BadRequestHttpException if there are missing or invalid parameters.
     */
    public function bindActionParams($action, $params)
    {
        if ($action instanceof InlineAction) {
            $method = new \ReflectionMethod($this, $action->actionMethod);
        } else {
            $method = new \ReflectionMethod($action, 'run');
        }

        if (isset($params['city']) and $params['city'] == 'e-mass')  $params['city'] = 'moskva';

        $args = [];
        $missing = [];
        $actionParams = [];
        $requestedParams = [];
        foreach ($method->getParameters() as $param) {
            $name = $param->getName();
            if (array_key_exists($name, $params)) {
                $isValid = true;
                if (PHP_VERSION_ID >= 80000) {
                    $isArray = ($type = $param->getType()) instanceof \ReflectionNamedType && $type->getName() === 'array';
                } else {
                    $isArray = $param->isArray();
                }
                if ($isArray) {
                    $params[$name] = (array)$params[$name];
                } elseif (is_array($params[$name])) {
                    $isValid = false;
                } elseif (
                    PHP_VERSION_ID >= 70000 &&
                    ($type = $param->getType()) !== null &&
                    $type->isBuiltin() &&
                    ($params[$name] !== null || !$type->allowsNull())
                ) {
                    $typeName = PHP_VERSION_ID >= 70100 ? $type->getName() : (string)$type;
                    switch ($typeName) {
                        case 'int':
                            $params[$name] = filter_var($params[$name], FILTER_VALIDATE_INT, FILTER_NULL_ON_FAILURE);
                            break;
                        case 'float':
                            $params[$name] = filter_var($params[$name], FILTER_VALIDATE_FLOAT, FILTER_NULL_ON_FAILURE);
                            break;
                        case 'bool':
                            $params[$name] = filter_var($params[$name], FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);
                            break;
                    }
                    if ($params[$name] === null) {
                        $isValid = false;
                    }
                }
                if (!$isValid) {
                    throw new BadRequestHttpException(Yii::t('yii', 'Invalid data received for parameter "{param}".', [
                        'param' => $name,
                    ]));
                }
                $args[] = $actionParams[$name] = $params[$name];
                unset($params[$name]);
            } elseif (PHP_VERSION_ID >= 70100 && ($type = $param->getType()) !== null && !$type->isBuiltin()) {
                try {
                    $this->bindInjectedParams($type, $name, $args, $requestedParams);
                } catch (Exception $e) {
                    throw new ServerErrorHttpException($e->getMessage(), 0, $e);
                }
            } elseif ($param->isDefaultValueAvailable()) {
                $args[] = $actionParams[$name] = $param->getDefaultValue();
            } else {
                $missing[] = $name;
            }
        }

        if (!empty($missing)) {
            throw new BadRequestHttpException(Yii::t('yii', 'Missing required parameters: {params}', [
                'params' => implode(', ', $missing),
            ]));
        }

        $this->actionParams = $actionParams;

        // We use a different array here, specifically one that doesn't contain service instances but descriptions instead.
        if (\Yii::$app->requestedParams === null) {
            \Yii::$app->requestedParams = array_merge($actionParams, $requestedParams);
        }

        return $args;
    }

}