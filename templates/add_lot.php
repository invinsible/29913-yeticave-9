<main>
    <nav class="nav">
        <ul class="nav__list container">
        <?php foreach ($categories as $category):?>
            <li class="nav__item">
                <a href="pages/all-lots.html"><?=esc($category['name']); ?></a>
            </li>
        <?php endforeach; ?>
        </ul>
    </nav>
    <?php $classname = count($errors) ? "form--invalid" : "";?>
    <form class="form form--add-lot container <?=$classname;?>" action="add.php" method="post"> <!-- form--invalid -->
        <h2>Добавление лота</h2>
        <div class="form__container-two">
            <?php $classname = isset($errors['lot-name']) ? "form__item--invalid" : "";
            $value = isset($lot_fields['lot-name']) ? $lot_fields['lot-name'] : "";?>
            <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
                <label for="lot-name">Наименование <sup>*</sup></label>
                <input id="lot-name" type="text" name="lot-name" placeholder="Введите наименование лота" value="<?=$value;?>">
                <span class="form__error">Введите наименование лота</span>
            </div>
            <?php $classname = isset($errors['lot-category']) ? "form__item--invalid" : "";?>
            <div class="form__item <?=$classname;?>">
                <label for="category">Категория <sup>*</sup></label>
                <select id="category" name="lot-category">
                <option value="">Выберите категорию</option>
                    <?php foreach ($categories as $category):?>
                        <option value="<?=$category['id']; ?>" <?php if ($category['id'] == $lot_fields['lot-category']) { ?>selected<?php } ?>><?=esc($category['name']); ?></option>     
                    <?php endforeach; ?>            
                </select>
                <span class="form__error">Выберите категорию</span>
            </div>
        </div>
        <?php $classname = isset($errors['lot-message']) ? "form__item--invalid" : "";
            $value = isset($lot_fields['lot-message']) ? $lot_fields['lot-message'] : "";?>
        <div class="form__item form__item--wide <?=$classname;?>">
        <label for="message">Описание <sup>*</sup></label>
        <textarea id="message" name="lot-message" placeholder="Напишите описание лота"><?=$value;?></textarea>
        <span class="form__error">Напишите описание лота</span>
        </div>
        <div class="form__item form__item--file">
        <label>Изображение <sup>*</sup></label>
        <div class="form__input-file">
            <input class="visually-hidden" type="file" id="lot-img" value="">
            <label for="lot-img">
            Добавить
            </label>
        </div>
        </div>
        <div class="form__container-three">
        <?php $classname = isset($errors['lot-rate']) ? "form__item--invalid" : "";
            $value = isset($lot_fields['lot-rate']) ? $lot_fields['lot-rate'] : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-rate">Начальная цена <sup>*</sup></label>
            <input id="lot-rate" type="text" name="lot-rate" placeholder="0" value="<?=$value;?>">
            <span class="form__error">Введите начальную цену</span>
        </div>
        <?php $classname = isset($errors['lot-step']) ? "form__item--invalid" : "";
            $value = isset($lot_fields['lot-step']) ? $lot_fields['lot-step'] : "";?>
        <div class="form__item form__item--small <?=$classname;?>">
            <label for="lot-step">Шаг ставки <sup>*</sup></label>
            <input id="lot-step" type="text" name="lot-step" placeholder="0" value="<?=$value;?>">
            <span class="form__error">Введите шаг ставки</span>
        </div>

        <?php $classname = isset($errors['lot-date']) ? "form__item--invalid" : "";
            $value = isset($lot_fields['lot-date']) ? $lot_fields['lot-date'] : "";?>
        <div class="form__item <?=$classname;?>">
            <label for="lot-date">Дата окончания торгов <sup>*</sup></label>
            <input class="form__input-date" id="lot-date" type="text" name="lot-date" placeholder="Введите дату в формате ГГГГ-ММ-ДД" value="<?=$value;?>">
            <span class="form__error">Введите дату завершения торгов</span>
        </div>
        </div>
        <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
        <button type="submit" class="button">Добавить лот</button>
    </form>
</main>