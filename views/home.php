<?php require_once(ROOT . '/views/layouts/header.view.php'); ?>

    <div class="container">
        <div class="col-md-6 col-md-offset-3">
            <br>
            <div class="form-area">
                <form id="form" method="POST" action="">
                    <br style="clear:both">
                    <h3 style="margin-bottom: 25px; text-align: center;">Регистрация</h3>
                    <div class="form-group">
                        <div class="alert alert-danger" role="alert"></div>
                        <input type="text" class="form-control" id="name" name="name" placeholder="ФИО" required>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger" role="alert"></div>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                    <div class="form-group">
                        <div class="alert alert-danger" role="alert"></div>
                        <select name="state" id="state" data-placeholder="Выберите область" required>
                            <option selected disabled>Выберите область</option>
                        </select>
                    </div>
                    <div class="form-group" style="display: none">
                        <div class="alert alert-danger" role="alert"></div>
                        <select name="city" id="city" data-placeholder="Выберите город" required></select>
                    </div>
                    <div class="form-group" style="display: none">
                        <div class="alert alert-danger" role="alert"></div>
                        <select name="district" id="district" data-placeholder="Выберите район"></select>
                    </div>
                    <button type="button" id="button" name="submit" class="btn btn-primary pull-right">Регистрация
                    </button>
                </form>
                <div style="display: none" class="well well-sm">
                    <div class="row">
                        <div class="col-sm-4 col-md-8">
                            <h4></h4>
                            <p>
                                <i class="glyphicon glyphicon-envelope"></i>
                                <br>
                                <i class="glyphicon glyphicon-home"></i>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php require_once(ROOT . '/views/layouts/footer.view.php'); ?>