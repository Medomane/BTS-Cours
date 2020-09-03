<style>
/*
.profile .image-container {
    position: relative;
}

.profile .image {
    opacity: 1;
    display: block;
    width: 100%;
    height: auto;
    transition: .5s ease;
    backface-visibility: hidden;
}

.profile .middle {
    transition: .5s ease;
    opacity: 0;
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    text-align: center;
}

.profile .image-container:hover .image {
    opacity: 0.3;
}

.profile .image-container:hover .middle {
    opacity: 1;
}
*/
</style>
<div class="container profile">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title mb-4">
                            <div class="d-flex justify-content-start">
                                <div class="image-container">
                                    <img src='<?= $user["avatar"] ?>' id="imgProfile" style="width: 150px; height: 150px" class="img-thumbnail" />
                                    <!--<?php //if(AuthUser::Get()["id"] === $user["id"] || AuthUser::IsAdministrator()){ ?>
                                        <form class="middle" action="//ROOT."users/avatar" " method="POST" id="form" enctype="multipart/form-data">
                                            <input type="button" name="salam" accept=".jpg, .jpeg, .png" class="btn btn-secondary" id="btnChangePicture" value="Change" />
                                            <input type="file" style="display: none;" id="profilePicture" name="file" />
                                        </form>
                                    <?php //} ?>-->
                                </div>
                                <div class="userData ml-3">
                                    <h2 class="d-block" style="font-size: 1.5rem; font-weight: bold"><?= $user["firstName"]." ".$user["lastName"] ?></h2>
                                    <h6 class="d-block"><i class="fas fa-envelope"></i> <?= $user["email"] ?></h6>
                                    <h6 class="d-block"><i class="fas fa-sign-in-alt"></i> <?= $user["registredAt"] ?></h6>
                                    <h6 class="d-block"><i class="fas fa-user-tag"></i> <?= $user["type"] ?></h6>
                                    <h6 class="d-block"><i class="fas fa-venus-mars"></i> <?= intval($user["gender"])==0?'Male':'Female' ?></h6>
                                    <!--<h6 class="d-block"><a href="javascript:void(0)">1,500</a> Video Uploads</h6>
                                    <h6 class="d-block"><a href="javascript:void(0)">300</a> Blog Posts</h6>-->
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-12">
                                <ul class="nav nav-tabs mb-4" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="basicInfo-tab" data-toggle="tab" href="#basicInfo" role="tab" aria-controls="basicInfo" aria-selected="true">Basic Info</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="connectedServices-tab" data-toggle="tab" href="#connectedServices" role="tab" aria-controls="connectedServices" aria-selected="false">Uploads</a>
                                    </li>
                                    <?php if($user["type"] === "professor") : ?>
                                    <li class="nav-item">
                                        <a class="nav-link" id="teachs-tab" data-toggle="tab" href="#teachs" role="tab" aria-controls="teachs" aria-selected="false">Modules</a>
                                    </li>
                                    <?php endif ?>
                                </ul>
                                <div class="tab-content ml-1" id="myTabContent">
                                    <div class="tab-pane fade show active" id="basicInfo" role="tabpanel" aria-labelledby="basicInfo-tab">
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Establishment</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?= $user["establishment"] ; ?>
                                            </div>
                                        </div>
                                        <?php if($user["type"] === "student") : ?>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Branch</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?= $user["branch"] ; ?>
                                            </div>
                                        </div>
                                        <hr/>
                                        <div class="row">
                                            <div class="col-sm-3 col-md-2 col-5">
                                                <label style="font-weight:bold;">Semester</label>
                                            </div>
                                            <div class="col-md-8 col-6">
                                                <?= $user["semester"] ; ?>
                                            </div>
                                        </div>
                                        <?php endif ?>
                                    </div>
                                    <div class="tab-pane fade" id="connectedServices" role="tabpanel" aria-labelledby="ConnectedServices-tab">
                                        <div class="list-group">
                                            <?php foreach($user["uploads"] as $k => $v){ ?>
                                            <a title="<?= $v["uploadedAt"] ?>" class="list-group-item list-group-item-action" target="_blank" href="<?= WEBROOT."uploads/".$v["path"] ?>"><?= pathinfo($v["path"], PATHINFO_BASENAME) ?>
                                                <ul>
                                                    <li><b>Branch : </b><?= $v["branch"] ?></li>
                                                    <li><b>Module : </b><?= $v["module"] ?></li>
                                                    <li><b>Unity : </b><?= $v["unity"] ?></li>
                                                    <li><b>Semester : </b><?= $v["semester"] ?></li>
                                                </ul>
                                            </a> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php if($user["type"] === "professor") : ?>
                                    <div class="tab-pane fade" id="teachs" role="tabpanel" aria-labelledby="teachs-tab">
                                        <div class="list-group">
                                            <?php foreach($user["modules"] as $k => $v){ ?>
                                            <a class="list-group-item list-group-item-action" href="javascript:void(0)"><?= $v["module"] ?>
                                                <ul>
                                                    <li><b>Branch : </b><?= $v["branch"] ?></li>
                                                    <li><b>Unity : </b><?= $v["unity"] ?></li>
                                                    <li><b>Semester : </b><?= $v["semester"] ?></li>
                                                </ul>
                                            </a> 
                                            <?php } ?>
                                        </div>
                                    </div>
                                    <?php endif ?>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
        </div>
    </div>
<script>
    $(document).ready(function () {
        /*$imgSrc = $('#imgProfile').attr('src');
        function readURL(input) {
            if (input.files && input.files[0]) {
                if(input.files[0].type.indexOf("image/") !== -1){
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imgProfile').attr('src', e.target.result);
                    };
                    reader.readAsDataURL(input.files[0]);
                    return true;
                }
            }
            return false;
        }
        $('#btnChangePicture').on('click', function () {
            $('#profilePicture').click();
        });
        $('#profilePicture').on('change', function () {
            let res = readURL(this);
            if(res === true) $("#form").submit();
            /*$('#btnChangePicture').addClass('changing');
            $('#btnChangePicture').attr('value', 'Confirm');
            $('#btnDiscard').removeClass('d-none');
            // $('#imgProfile').attr('src', '');
        });*/
        
        /*$('#btnDiscard').on('click', function () {
            // if ($('#btnDiscard').hasClass('d-none')) {
            $('#btnChangePicture').removeClass('changing');
            $('#btnChangePicture').attr('value', 'Change');
            $('#btnDiscard').addClass('d-none');
            $('#imgProfile').attr('src', $imgSrc);
            $('#profilePicture').val('');
            // }
        });*/
    });
</script>