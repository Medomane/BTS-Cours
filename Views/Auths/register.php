<table style="position:absolute;top:0px;left:0px;right:0px;bottom:0px;width:100%;height:100%;">
    <tr>
        <td style="vertical-align:middle">
            <div class="p-2">
                <div style="max-width: 200px;max-height:200px;" class="m-auto">
                    <img src='<?=WEBROOT."img/users.png" ?>' alt="users" class="w-100 h-100">
                </div>
                <div style="max-width: 400px;margin:auto;"><?= Notify::getHTML(); ?></div>
                <form method="POST" style="margin:auto;max-width: 400px" id="form">
                    <div class="old">
                        <div class="form-group">
                            <label for="firstName">First name</label>
                            <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First name" required>
                        </div>
                        <div class="form-group">
                            <label for="lastName">Last name</label>
                            <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" placeholder="Enter email" required>
                            <div class="valid-feedback">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select name="gender" required class="form-control" id="gender">
                                <option value="0">Male</option>
                                <option value="1">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" autocomplete name="password" class="form-control" id="password" placeholder="Password" required>
                            <div class="valid-feedback"></div>
                        </div>
                        <div class="form-group">
                            <label for="passwordVer">Retype password</label>
                            <input type="password" autocomplete name="passwordVer" class="form-control" id="passwordVer" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-next">Next <i class="fas fa-arrow-right"></i></button>
                    </div>
                    <div class="next">
                        <div class="form-group">
                            <label for="type">Type</label>
                            <select name="type" required class="form-control" id="type">
                                <option value="professor">Professor</option>
                                <option value="student">Student</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="establishment">Establishment</label>
                            <select name="establishment" required class="form-control" id="establishment">
                                <option value="0"></option>
                                <?php foreach($establishments as $k => $v) : ?>
                                    <option value="<?= $v["id"] ?>"><?= $v["name"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="branch">Branchs</label>
                            <select name="branch" class="form-control" id="branch">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="module">Modules</label>
                            <select multiple="multiple" name="module[]" id="module" style="width:100%;">
                                
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="semester">Semester</label>
                            <select name="semester" required class="form-control" id="semester">
                                <?php foreach($semesters as $k => $v) : ?>
                                    <option value="<?= $v["id"] ?>"><?= $v["semester"] ?></option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div>
                            <div class="btn btn-info btn-back"><i class="fas fa-arrow-left"></i> Back</div>
                            <div class="float-right">
                                <button type="submit" name="submit" class="btn btn-primary">
                                    <i class="fas fa-stroopwafel fa-spin" style="display:none;"></i> Submit
                                </button>
                                Or <a href='<?= ROOT.'auths' ?>'>signIn</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </td>
    </tr>
</table>
<script>
    $(function(){
        $('#module').multipleSelect({
            multiple: true,
            multipleWidth: 60,
            selectAll: false,
            filter: true,
            filterGroup: true
        });
        $('#semester').parent(".form-group").hide();
        $('#branch').parent(".form-group").hide();
        $('.next').hide();
        $(".btn-back").click(function(){
            $(".next").slideUp(200);
            $(".old").slideDown(200);
        });
        $("#type").change(function(){
            var selected = $(this).children("option:selected").val();
            $('#module').parent(".form-group").toggle(200);
            $('#semester').parent(".form-group").toggle(200);
            $('#branch').parent(".form-group").toggle(200);
        });
        $("#establishment").change(function(){
            var establishmentId = parseInt($(this).children("option:selected").val());
            let type = $("#type").children("option:selected").val();
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
                    var dt = {establishment_id:establishmentId,user_id:0};
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
                                    var $opt = $('<option />', {
                                        value: e1.id,
                                        text: e1.semester
                                    });
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
                            let str = "<option value='0'></option>";
                            $.each(data,function(i,e){
                                str += "<option value='"+e.id+"'>"+e.branch+"</option>"
                            });
                            $("#branch").html(str);
                        }
                    });
                }
            }
        });
        $("#form").submit(function(e){
            e.preventDefault();
            if($(".old").css("display") !== "none"){
                let verified = true;
                $.each($(".old input[type=text],.old input[type=email]"),function(i,e){
                    if($(this).val().trim() == ''){
                        $(this).addClass("is-invalid");
                        verified = false;
                    }
                    else $(this).removeClass("is-invalid");
                });
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
                if(verified) {
                    $.get('<?= ROOT."auths/jsonCheckEmail/" ?>'+Base64EncodeUrl($("#email").val()), function(data, status){
                        if(status === "success"){
                            if(data.message === "success"){
                                $("#email").siblings(".valid-feedback").css("display","none");
                                $(".next").slideDown(200);
                                $(".old").slideUp(200);
                            }
                            else $("#email").siblings(".valid-feedback").text(data.message+" !!!").css("display","block");
                        }
                    });
                }
            }
            else{
                let verified = true;
                var type = $("#type").children("option:selected").val();
                $.each($(".next select"),function(){
                    if($(this).attr("id") !== "type"){
                        let selected = $(this).val();
                        if($(this).parent(".form-group").css("display") === "block"){
                            let tmp = ($(this).attr("id") == "module")?selected.length >0:selected >0;
                            if(tmp > 0) $(this).removeClass("is-invalid");
                            else {
                                $(this).addClass("is-invalid");
                                verified = false;
                            }
                        }
                    }
                });
                if(verified === true){
                    $(".fa-stroopwafel").css("display","inline-block");
                    $(".fa-stroopwafel").parent("button").attr("disabled","disabled");
                    $.post('<?= ROOT."auths/jsonRegister" ?>', $('#form').serialize(),function(data,status){
                        if(status == "success"){
                            if(data.message !== "success"){
                                Swal.fire(
                                    'Error',
                                    data.message,
                                    'error'
                                );
                            }
                            else window.location = "<?= ROOT."auths" ?>";
                        }
                        $(".fa-stroopwafel").css("display","none");
                        $(".fa-stroopwafel").parent("button").removeAttr("disabled");
                    });
                }
            }
        });
    });
    function Base64EncodeUrl(str){
        str = btoa(str);
        return str.replace(/\+/g, '-').replace(/\//g, '_').replace(/\=+$/, '');
    }
</script>