<?php
require_once ('site_modules/header.php'); ?>
<div class="background_img" id="backgroundImg">
</div>
<?php require_once ('site_modules/navbar.php'); ?>

<div class="background_img_2" id="backgroundImg2">
  <img src="img/background/back2.svg" alt="background2" />
</div>


<section class="slogan">
  <div class="body_area">
    <div class="flex_main_div">
      <img src="img/logoPastel.svg" alt="logostudmax" />
      <div class="slogan_text show-animate" id="animation_section">
        <h1 class="title_reveal animate" data-aos="fade-right">
          Найди работу вместе с <br />
          STUDMAX
        </h1>
      </div>
    </div>
  </div>
</section>

<section class="main_news">
  <div class="body_area">
    <div class="news_flex_div">
      <!--! слайдер-->
      <div class="wrapper">
        <div class="container">
          <input type="radio" name="slide" id="c1" checked />
          <label for="c1" class="card">
            <div class="row">
              <div class="icon">1</div>
              <div class="description">
                <h4>Поиск работы</h4>
                <p>STUDMAX - Представляет новый веб-сервис для выпускников</p>

              </div>
            </div>
          </label>
          <input type="radio" name="slide" id="c2" />
          <label for="c2" class="card">
            <div class="row">
              <div class="icon">2</div>
              <div class="description">
                <h4>Эффективность</h4>
                <p>Оптимизирует трудоустройство среди молодых профессионалов</p>

              </div>
            </div>
          </label>
          <input type="radio" name="slide" id="c3" />
          <label for="c3" class="card">
            <div class="row">
              <div class="icon">3</div>
              <div class="description">
                <h4>Новые горизонты</h4>
                <p>Революционизирует поиск работы выпускников ПТУ</p>

              </div>
            </div>
          </label>
          <input type="radio" name="slide" id="c4" />
          <label for="c4" class="card">
            <div class="row">
              <div class="icon">4</div>
              <div class="description">
                <h4>Инклюзивные возможности</h4>
                <p>Обеспечивает равные возможности для молодых специалистов</p>
              </div>
            </div>
          </label>
        </div>
      </div>
      <main>
        <div class="news_text" data-aos="fade-right">
          <h2>Новости</h2>
          <p>
            STUDMAX - веб-сервис, разработанный с целью поддержки и
            содействия трудоустройству выпускников учреждений среднего
            профессионального образования. <br /><br />
            Проект создан с учетом современных требований рынка труда и
            потребностей молодых специалистов.
          </p>
        </div>
      </main>
    </div>
  </div>
</section>

<section class="mobile_section" id="animation_section">
  <div class="body_area">
    <div class="mobile_flex">
      <div class="mobile_text" data-aos="fade-up-right">
        <div>
          <h2>Скачайте приложение</h2>
          <p>
            Свежие вакансии всегда у вас под <br />
            рукой.
          </p>
        </div>
      </div>
      <div class="mibile_icon">
        <img src="img/mobile.svg" alt="mobile svg image" />
        <button type="button" id="workingButton">
          Скачать
        </button>
      </div>
    </div>
  </div>
</section>

<section class="popular" id="popularSection">
  <!--<img class="back3" src="img/background/back3.svg" alt="back3" />-->
  <div class="popular_area">
    <div class="body_area">
      <h2 class="popularH2" data-aos="flip-up">Популярные вакансии</h2>
      <div class="popular_flex">
        <div class="popular_grid">
          <a href="katalog.php">
            <span></span>
            <div>
              <h3>Php junior developer</h3>
              <p>До 100000</p>
              <p>3 вакансии</p>
            </div>
          </a>

          <a href="katalog.php">
            <span></span>
            <div>
              <h3>Менеджер</h3>
              <p>До 60000</p>
              <p>4 вакансии</p>
            </div>
          </a>

          <a href="katalog.php">
            <span></span>
            <div>
              <h3>Оператор станков</h3>
              <p>До 80000</p>
              <p>3 вакансии</p>
            </div>
          </a>

          <a href="katalog.php">
            <span></span>
            <div>
              <h3>Frontend junior developer</h3>
              <p>До 100000</p>
              <p>3 вакансии</p>
            </div>
          </a>
        </div>

        <div class="swiper sw-mar">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide slide1">
              <div class="slide_black_area">
                <h3>IT Специалисты</h3>
                <p>
                  Востребованные вакансии: разработчики, аналитики, системные администраторы. Обучение и карьерный рост
                  обеспечены в ведущих IT-компаниях.
                </p>
              </div>
            </div>
            <div class="swiper-slide slide2">
              <div class="slide_black_area">
                <h3>Веб Дизайнеры</h3>
                <p>
                  Требуемые навыки: UI/UX дизайн, владение графическими программами, опыт работы с веб-технологиями.
                  Широкие перспективы в дизайн-студиях и IT-компаниях.
                </p>
              </div>
            </div>
            <div class="swiper-slide slide3">
              <div class="slide_black_area">
                <h3>Продажи и Маркетинг</h3>
                <p>
                  Вакансии: менеджеры по продажам, маркетологи, рекламные агенты. Ведущие компании предлагают
                  конкурентоспособные условия и бонусы.
                </p>
              </div>
            </div>
            <div class="swiper-slide slide4">
              <div class="slide_black_area">
                <h3>3D Моделирование</h3>
                <p>
                  Требуемые навыки: навыки работы с 3D-программами, творческий подход к созданию моделей, знание
                  принципов компьютерной графики. Вакансии в геймдеве, архитектуре и рекламе.
                </p>
              </div>
            </div>
            <div class="swiper-slide slide5">
              <div class="slide_black_area">
                <h3>Тестировщики</h3>
                <p>
                  Востребованные вакансии в сфере информационных технологий не ограничиваются только разработчиками,
                  аналитиками и системными администраторами. Тестировщики также играют важную роль в процессе создания и
                  поддержки программного обеспечения.
                </p>
              </div>
            </div>
            <div class="swiper-slide slide6">
              <div class="slide_black_area">
                <h3>Системные администраторы</h3>
                <p>
                  Требуемые навыки: управление серверами, настройка сетевых устройств, знание операционных систем.
                  Вакансии в корпоративных IT-отделах, хостинг-провайдерах и облачных сервисах.
                </p>
              </div>
            </div>
          </div>
          <div class="swiper-pagination bullets"></div>

          <div class="autoplay-progress">
            <svg viewBox="0 0 48 48">
              <circle cx="24" cy="24" r="20"></circle>
            </svg>
            <span></span>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<section class="offers" id="animation_section">
  <div class="body_area">
    <div class="grid_offers">
      <div class="offer1">
        <h2 data-aos="fade-right">Мы предлагаем</h2>
      </div>
      <div class="offer2">
        <img src="img/LogoDBlue.svg" alt="logo STUDMAX" />
      </div>
      <a class="offer3" href="rez_help.php">
        <p>Помощь с созданием резюме</p>
      </a>
      <a class="offer4" href="materials.php">
        <p>Полезные материалы</p>
      </a>
      <a class="offer5" id="sobes" href="#">
        <p>Подготовка к собеседованию</p>
      </a>
    </div>
  </div>
</section>
<script>
document.getElementById('workingButton').addEventListener('click', function () {
  // Отображение обычного предупреждения при нажатии на кнопку
  alert("В разработке");
});

document.getElementById('sobes').addEventListener('click', function () {
  // Отображение обычного предупреждения при нажатии на кнопку
  alert("В разработке");
});

</script>
<script src="js/mainPage_scroll.js" defer></script>
<script src="js/swipe.js" defer></script>
<script src="js/menu.js"></script>


<?php require_once ('site_modules/footer.php') ?>