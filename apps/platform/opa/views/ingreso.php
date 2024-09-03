<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row mb-1"></div>
        <div class="content-body">

            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <img src="<?= $dominion; ?>resources/img/olc-platform-logo.png" alt="branding logo">
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Zoom Admin</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">

                                    <form action="general/login" id="formion" name="formion" method="post" class="form-horizontal zoom_form">
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="text" class="form-control" name="user-name" id="user-name" placeholder="Usuario" required>
                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input type="password" class="form-control" name="user-password" id="user-password" placeholder="Contraseña" required>
                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                        <div id="rtn-formion" class="taC mb20"></div>
                                        <button type="submit" class="btn btn-outline-blue-grey btn-block"><i class="ft-unlock"></i> Ingresar</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

        </div>
    </div>
</div>