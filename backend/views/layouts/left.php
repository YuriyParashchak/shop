<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p>Alexander Pierce</p>

                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?php
        $cID = Yii::$app->controller->id;
        $aID = Yii::$app->controller->action->id;

        echo dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget'=> 'tree'],
                'items' => [
                    ['label' => 'Menu Yii2', 'options' => ['class' => 'header']],
                    [
                            'label' => Yii::t('user','Users') ,
                        'icon' => 'fas fa-users',
                        'active' => $cID == 'user' || $cID == 'role',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('user','Users'), 'icon' => 'fas fa-users', 'url' => ['/user/'], 'active' => $cID == 'user'],
                            ['label' => Yii::t('user','Role'), 'icon' => 'dashboard', 'url' => ['/role/'], 'active' => $cID == 'role'],
                    ],],
                    [
                        'label' => Yii::t('user','Message') ,
                        'icon' => ' fas fa-envelope ',
                        'active' => $cID == 'support-request' || $cID == 'contact-subject',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('user','Message'), 'icon' => 'fas fa-envelope', 'url' => ['/support-request'], 'active' => $cID == 'support-request'],
                            ['label' => Yii::t('user','Topics'), 'icon' => 'dashboard', 'url' => ['/contact-subject'], 'active' => $cID == 'contact-subject'],
                        ],],
                    ['label' => 'Product', 'icon' => 'fab fa-product-hunt',  'active' => $cID == 'product','url' => ['/product']],
                    ['label' => 'Category', 'icon' => 'fas fa-th-list', 'active' => $cID == 'category', 'url' => ['/category/category/']],
                    ['label' => 'Currency', 'icon' => 'fas fa-money', 'active' => $cID == 'currency','url' => ['/currency/']],

                    [
                        'label' => Yii::t('blog','Blog') ,
                        'icon' => 'fas fa-rss-square ',
                        'active' => $cID == 'blog' || $cID == 'category-blog'|| $cID=='comment-blog',
                        'url' => '#',
                        'items' => [
                            ['label' => Yii::t('blog','Blog'), 'icon' => 'fas fa-rss-square',  'active' => $cID == 'blog','url' => ['/blog/']],
                            ['label' => Yii::t('blog','Create category'), 'icon' => 'fas fa-rss-square', 'active' => $cID == 'category-blog', 'url' => ['/category-blog/']],
                            ['label' => Yii::t('blog','Comment'), 'icon' => 'fas fa-rss-square', 'active' => $cID == 'comment-blog', 'url' => ['/comment-blog/']],
                        ],],
                    ['label' => Yii::t('slider','Slider'), 'icon' => 'fa fa-sliders','active' => $cID == 'slider-image', 'url' => ['/slider-image/']],
                    ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug']],
                    ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                    [
                        'label' => 'Some tools',
                        'icon' => 'share',
                        'url' => '#',
                        'items' => [
                            ['label' => 'Gii', 'icon' => 'file-code-o', 'url' => ['/gii'],],
                            ['label' => 'Debug', 'icon' => 'dashboard', 'url' => ['/debug'],],
                            [
                                'label' => 'Level One',
                                'icon' => 'circle-o',
                                'url' => '#',
                                'items' => [
                                    ['label' => 'Level Two', 'icon' => 'circle-o', 'url' => '#',],
                                    [
                                        'label' => 'Level Two',
                                        'icon' => 'circle-o',
                                        'url' => '#',
                                        'items' => [
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                            ['label' => 'Level Three', 'icon' => 'circle-o', 'url' => '#',],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
                    ]
        ) ?>

    </section>

</aside>
