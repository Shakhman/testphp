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
    <button type="button" id="button" name="submit" class="btn btn-primary pull-right">Регистрация</button>
</form>