<?php

$cookiesRequest = Yii::$app->response->cookies;

$userOrder = $cookiesRequest->getValue('sort_price');

echo '<div class="col-12 select-cust ">'; ?>

    <select class="form-control sort_select" name="sort">
        <option <?php if ($userOrder == 'default') echo 'selected'?> value="price=default">Сортировка по умолчанию</option>
        <option <?php if ($userOrder == 'up') echo 'selected'?> value="price=up">По возрастанию цены</option>
        <option <?php if ($userOrder == 'down') echo 'selected'?> value="price=down">По убыванию цены</option>
        <option <?php if ($userOrder == 'age-up') echo 'selected'?> value="price=age-up">От молодых к зрелым</option>
        <option <?php if ($userOrder == 'age-down') echo 'selected'?> value="price=age-down">От зрелых к молодым</option>
    </select>

<?php echo '</div>';