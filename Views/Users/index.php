<style>
    /* FontAwesome for working BootSnippet :> */

#team {
    background: #eee !important;
}

.btn-primary:hover,
.btn-primary:focus {
    background-color: #108d6f;
    border-color: #108d6f;
    box-shadow: none;
    outline: none;
}

.btn-primary {
    color: #fff;
    background-color: #007b5e;
    border-color: #007b5e;
}

section {
    padding: 10px 0;
}

section .section-title {
    text-align: center;
    color: #007b5e;
    margin-bottom: 50px;
    text-transform: uppercase;
}

#team .card {
    border: none;
    background: #ffffff;
}

.mainflip {
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -ms-transition: 1s;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
    position: relative;
}

.frontside {
    position: relative;
    z-index: 2;
    margin-bottom: 30px;
}

.frontside {
    -webkit-backface-visibility: hidden;
    -moz-backface-visibility: hidden;
    -ms-backface-visibility: hidden;
    backface-visibility: hidden;
    -webkit-transition: 1s;
    -webkit-transform-style: preserve-3d;
    -moz-transition: 1s;
    -moz-transform-style: preserve-3d;
    -o-transition: 1s;
    -o-transform-style: preserve-3d;
    -ms-transition: 1s;
    -ms-transform-style: preserve-3d;
    transition: 1s;
    transform-style: preserve-3d;
}

.frontside .card {
    min-height: 312px;
}

.frontside .card .card-title {
    color: #007b5e !important;
}

.frontside .card .card-body img {
    width: 120px;
    height: 120px;
    border-radius: 50%;
}
</style>
<section id="team" class="pb-5">
    <div class="container">
        <h5 class="section-title h1"><?= ucfirst($type)."s"?></h5>
        <div class="row">
            <?php foreach($users as $k=>$v) {?>
                <div class="col-xs-12 col-sm-6 col-md-4">
                    <div class="image-flip" >
                        <div class="mainflip flip-0">
                            <div class="frontside">
                                <div class="card">
                                    <div class="card-body text-center">
                                        <p><img class=" img-fluid" src="<?= file_exists(WEBROOT."img/avatars/".$v["id"].".png")?
                                            WEBROOT."img/avatars/".$v["id"].".png":
                                            WEBROOT."img/".$v["gender"].".png" ?>" alt="card image"></p>
                                        <h4 class="card-title"><a href="<?= ROOT.'users/profile/'.$v['id'] ?>" style="text-decoration: none;color:unset"><?= $v["firstName"]." ".$v["lastName"] ?></a></h4>
                                        <p class="card-text">
                                        <?= $v["establishment"]?>
                                        </p>
                                        <?php if(AuthUser::IsAdministrator()){ ?>
                                            </br>
                                            <div>
                                                <div onclick="editFile('<?= ROOT.'users/activated/'.$v['id'] ?>',$(this))" class="btn btn-warning btn-sm" title="<?= intval($v["activated"])==0?'Activate':'Deactivate'?>"><i class="fa <?= intval($v["activated"])==0?'fa-check-circle':'fa-minus-circle'?>"></i></div>
                                                <div href="#" onclick="editFile('<?= ROOT.'users/delete/'.$v['id'] ?>',$(this))" class="btn btn-danger btn-sm" title="Delete"><i class="fa fa-trash-alt"></i></div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal fade" id="<?= 'user_'.$v["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"><?= $v["lastName"]." teachs :" ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                            <ul class="list-group">
                                <?php foreach($v["modules"] as $mk => $mv) : ?>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <?= "<b>(S".$mv["semester"].")</b> ".$mv["module"] ?>
                                    <span class="badge badge-primary badge-pill"><?= explode('-',$mv["branch"])[0] ?></span>
                                </li>
                                <?php endforeach ?>
                            </ul>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>
<!-- Team -->
<script>
    function editFile(url,t){
        if(url.indexOf("delete") !== -1){
            let card = t.parents(".image-flip").parent("div");
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                if (result.value) {
                    $.get(url,function(data,status){
                        if(status === "success"){
                            card.fadeOut(300,function(){
                                card.remove();
                            });
                        }
                    });
                }
            });
        }
        else{
            $.get(url,function(data,status){
                if(status === "success"){
                    t.find('i').toggleClass('fa-check-circle').toggleClass('fa-minus-circle');
                    t.attr("title",(t.attr("title") === "Confirm"?"Annul":"Confirm"));
                }
            });
        }
    }
</script>