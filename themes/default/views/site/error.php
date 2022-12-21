<div class="error-404">
    <div class="container error-404__wrapper">
        <div class="star-s">
            <?= file_get_contents('.' . $this->mainAssets . '/images/404/star-white-s.svg') ?>
        </div>
        <div class="error-404__text">
            <h2>
                4
                <?= file_get_contents('.' . $this->mainAssets . '/images/404/star-black.svg') ?>
                4
            </h2>

            <h3>
                Страница не найдена
            </h3>

            <p class="alert alert-danger">
                В этот раз магия не сработала, наша мастерская работает над этим, а пока - вернитесь на главную страницу сайта.
            </p>

            <a href="/">
                Перейти на главную
            </a>
        </div>
        <div class="star-b">
            <?= file_get_contents('.' . $this->mainAssets . '/images/404/star-white-b.svg') ?>
        </div>
    </div>
</div>