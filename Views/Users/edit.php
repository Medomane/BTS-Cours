<form method="POST" id="form" style="max-width:600px;margin:auto;" enctype="multipart/form-data">
    <div style="max-width: 200px;max-height:200px;" class="m-auto">
        <img src='<?=WEBROOT."img/edit.png" ?>' alt="users" class="w-100 h-100">
    </div>
    <div style="width:100%;display:none;" class='alert'>Edited successfully</div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-6">
            <label for="firstName">First name</label>
            <input type="text" name="firstName" class="form-control" value="<?= AuthUser::Get()["firstName"] ?>" id="firstName" placeholder="First name" required>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="lastName">Last name</label>
            <input type="text" name="lastName" class="form-control" value="<?= AuthUser::Get()["lastName"] ?>" id="lastName" placeholder="Last name" required>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="password">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Password">
            <div class="valid-feedback"></div>
        </div>
        <div class="form-group col-xs-12 col-md-6">
            <label for="passwordVer">Retype password</label>
            <input type="password" name="passwordVer" class="form-control" id="passwordVer" placeholder="Password">
        </div>
        <?php if(AuthUser::Get()["type"] !== "guest") : ?>
            <div class="form-group col-12">
                <label for="establishment">Establishment</label>
                <select name="establishment" required class="form-control" id="establishment">
                    <?php foreach($establishments as $k => $v) : ?>
                        <option value="<?= $v["id"] ?>" <?= (intval($v["id"]) === intval(AuthUser::Get()["establishment_id"])?'selected="selected"':'') ?>><?= $v["name"] ?></option>
                    <?php endforeach ?>
                </select>
            </div>
            <?php if(AuthUser::Get()["type"] === "professor") : ?>
                <div class="form-group col-12">
                    <label for="module">Modules</label>
                    <select multiple="multiple" name="module[]" id="module" style="width:100%;" required>
                        
                    </select>
                </div>
            <?php else : ?>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="branch">Branchs</label>
                    <select name="branch" class="form-control" id="branch">
                        
                    </select>
                </div>
                <div class="form-group col-xs-12 col-md-6">
                    <label for="semester">Semester</label>
                    <select name="semester" required class="form-control" id="semester">
                        <?php foreach($semesters as $k => $v) : ?>
                            <option value="<?= $v["id"] ?>" <?= (intval($v["id"]) === intval(AuthUser::Get()["semester_id"])?'selected="selected"':'') ?>><?= $v["semester"] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            <?php endif ?>
        <?php endif ?>
    </div>
    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-check"></i> Validate</div>
</form>
<script>
    $(function(){
        let type = '<?= AuthUser::Get()["type"] ?>';
        let isGuest = type === "guest";
        if(!isGuest){
            $('#module').multipleSelect({
                multiple: true,
                multipleWidth: 60,
                selectAll: false,
                filter: true,
                filterGroup: true
            });
            $select = $("#module");
            refreshModules();
            $("#establishment").change(function(){
                refreshModules();
            });
        }
        $("#form").submit(function(e){
            e.preventDefault();
            $("#form div.alert").fadeOut();
            let verified = true;
            $.each($("#form .row input[type=text]"),function(i,e){
                if(!$(this).attr('id')) return ;
                if($(this).val().trim() == ''){
                    $(this).addClass("is-invalid");
                    verified = false;
                }
                else $(this).removeClass("is-invalid");
            });
            if($("#password").val().trim() != ''){
                if($("#password").val().trim().length<8){
                $("#password").siblings(".valid-feedback").text("8 characters in password !!!").css("display","block");
                    verified = false;
                }
                else{
                    if($("#password").val().trim() != $("#passwordVer").val().trim()){
                        $("#password").siblings(".valid-feedback").text("Password doesn't match !!!").css("display","block");
                        verified = false;
                    }
                    else $("#password").siblings(".valid-feedback").css("display","none");
                }
            }
            //if(type == 'professor'){if($select.multipleSelect('getSelects').length <= 0) verified = false;}
            if(verified) {
                $("button i").removeClass('fa-check').addClass("fa-stroopwafel").addClass('fa-spin');
                $("button").attr("disabled","disabled");
                $.post('<?= ROOT."users/edit" ?>',$('#form').serialize(),function(data,status){
                    console.log(data);
                    if(status === 'success'){
                        if(data.message === 'success') $("#form div.alert").addClass('alert-success').fadeIn(300);
                        else $("#form div.alert").addClass('alert-danger').text(data.message).fadeIn(300);
                    }
                    $("button i").removeClass("fa-stroopwafel").removeClass('fa-spin').addClass('fa-check');
                    $("button").removeAttr("disabled");
                });
            }
        });
        function refreshModules(){
            var establishmentId = parseInt($("#establishment").children("option:selected").val());
            let type = '<?= AuthUser::Get()["type"] ?>';
            $select = $("#module");
            $select.multipleSelect('destroy');
            $select.html(null);
            if(type == "professor"){
                if(establishmentId > 0){
                    $('#module').multipleSelect({
                        multiple: true,
                        multipleWidth: 60,
                        selectAll: false,
                        filter: true,
                        filterGroup: true
                    });
                    var dt = {cond:'establishment_id = '+establishmentId+' AND (user_id = 0 OR user_id = '+<?= AuthUser::Get()["id"] ?>+')'};
                    $.post('<?= ROOT."modules/jsonModules" ?>',dt, function(data, status){
                        if(status == "success"){
                            var x = {};
                            for (var i = 0; i < data.length; ++i) {
                                var obj = data[i];
                                let key = '('+obj.abbreviated+') '+obj.module;
                                if (x[key] === undefined) x[key] = {name:key,value:[]};
                                let tmp = data.filter(function(e){
                                    return e.module_id === obj.module_id; 
                                });
                                x[key].value.push(tmp);
                            }
                            $.each(x,function(i,e){
                                e.value = e.value[0];
                                var $optGrp = $('<optgroup />', {
                                    label: e.name
                                });
                                $.each(e.value,function(i1,e1){
                                    let attr = {
                                        value: e1.id,
                                        text: 'S'+e1.semester
                                    };
                                    if(parseInt(e1.user_id) === parseInt(<?= AuthUser::Get()["id"] ?>)) attr.selected = 'selected';
                                    var $opt = $('<option />', attr);
                                    $optGrp.append($opt);
                                });
                                $select.append($optGrp).multipleSelect('refresh');
                            });
                        }
                    });
                }
            }
            else{
                $("#branch").html(null);
                if(establishmentId != 0){
                    $.get('<?= ROOT."branchs/jsonBranchsByEstablishment/" ?>'+establishmentId, function(data, status){
                        if(status == "success"){
                            let str = "";
                            $.each(data,function(i,e){
                                let s = parseInt(e.id) === <?= intval(AuthUser::Get()["lineBranch_id"]) ?>;
                                str += "<option value='"+e.id+"' "+(s?'selected="selected"':'')+">"+e.branch+"</option>"
                            });
                            $("#branch").html(str);
                        }
                    });
                }
            }
        }
    });
</script>