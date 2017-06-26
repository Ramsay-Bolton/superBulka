<?php include ROOT . '/views/layouts/header.php'; ?>

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Каталог</h2>
                    <div class="panel-group category-products">
                        <?php foreach ($categories as $categoryItem): ?>
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <!--<h4 class="panel-title">-->
                                    <a href="/category/<?php echo $categoryItem['id']; ?>">
                                        <?php echo $categoryItem['name']; ?>
                                    </a>
                                    <!--</h4>-->
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Последние товары</h2>
                    <p>
                        Lorem ipsum dolor sit amet, an eruditi definitiones cum, no pertinacia vituperata persequeris per, ei est dicam audire officiis. Ex nec sale audire blandit, dicant iracundia ei qui. At cum suas saperet vituperata. Inani antiopam eu duo, eos ei scaevola verterem, ne dicta tantas vituperatoribus nec.

                        Docendi iracundia gloriatur cum te. Ut hinc bonorum similique eos, vel illud labitur periculis ei. His eu nihil labore dignissim, quod fugit prompta vim ex. Eam apeirian ocurreret ex, saepe vituperata vix ut.

                        Tibique adipisci honestatis ea est, veritus principes ne quo, mazim aperiri repudiandae in vis. Et assentior maiestatis dissentiunt sed. An his malis insolens, postea nostrum ut mea. Vix purto necessitatibus id, zril detraxit corrumpit mea et.

                        Elit quidam in usu, cu falli dolore sea. Qui in ludus vivendum. An iriure ancillae signiferumque his. Vim id tota modus delicata, ius no animal labores. Consequat assueverit voluptatibus sed cu, elitr possim constituto at eos.

                        Te sint dicam sed. Aeque bonorum ei eos, cu odio ridens ius. Pro te quis suscipiantur, inani necessitatibus ea est, eam no probo cetero. Ignota pertinax deterruisset sit ut, has esse nostrud in. Ut minim definitionem nec, eum equidem imperdiet instructior id.

                        Ne aliquam salutandi his, ornatus volutpat ne mel. Sit iusto offendit cu, ei wisi vivendum eos, agam libris deseruisse vim at. Suas quaeque scripserit qui ei, vide senserit ex eum, eum illud etiam explicari ei. Cu pro novum laoreet fabellas. Per dicam legendos constituam ut.

                        Ad saperet fierent sed, sea ne enim dicam, mea persius copiosae instructior te. Putant dictas oblique no cum, amet probo vis an, homero graece putant eos et. Velit accusam liberavisse vis ex, possim praesent mea ne. Ea quo meis libris vocent, sumo cetero has eu.

                        Sed an nemore expetenda, per ridens pericula posidonium at. Simul melius vis ea. Mel id modo assum.
                    </p>
                </div><!--features_items-->

                <div class="recommended_items"><!--recommended_items-->
                    <h2 class="title text-center">Рекомендуемые товары</h2>

                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <div class="item active">
                                <?php foreach ($recommendedProducts as $product): ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo '/template/images/home/product1' . $product['category_id'] . '.jpg'; ?>" alt="" />
                                                    <h2><?php echo $product['price']; ?> -RUB</h2>
                                                    <p><?php echo $product['name']; ?></p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                            <div class="item">
                                <?php foreach ($recommendedProducts as $product): ?>
                                    <div class="col-sm-4">
                                        <div class="product-image-wrapper">
                                            <div class="single-products">
                                                <div class="productinfo text-center">
                                                    <img src="<?php echo '/template/images/home/product1' . $product['category_id'] . '.jpg'; ?>" alt="" />
                                                    <h2><?php echo $product['price']; ?> -RUB</h2>
                                                    <p><?php echo $product['name']; ?></p>
                                                    <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>В корзину</a>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>			
                    </div>
                </div><!--/recommended_items-->

            </div>
        </div>
    </div>
</section>

<?php include ROOT . '/views/layouts/footer.php'; ?>       

