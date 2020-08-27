<form method="POST" style="margin:auto;max-width: 400px" id="form" enctype="multipart/form-data">
    <div style="max-width: 200px;max-height:200px;" class="m-auto">
        <img src='<?=WEBROOT."img/upload.png" ?>' alt="users" class="w-100 h-100">
    </div>
    <div style="max-width: 400px;margin:auto;"><?= Notify::getHTML(); ?></div>
    <div class="form-group">
        <label for="establishment">Establishment</label>
        <select name="establishment" required class="form-control" id="establishment" required>
            <option value="0"></option>
            <?php foreach($establishments as $k => $v) : ?>
                <option value="<?= $v["id"] ?>"><?= $v["name"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="branch">Branchs</label>
        <select name="branch" class="form-control" id="branch" required>
            
        </select>
    </div>
    <div class="form-group">
        <label for="semester">Semesters</label>
        <select name="semester" class="form-control" id="semester" required>
            <option value="0"></option>
            <?php foreach($semesters as $k => $v) : ?>
                <option value="<?= $v["id"] ?>"><?= $v["semester"] ?></option>
            <?php endforeach ?>
        </select>
    </div>
    <div class="form-group">
        <label for="module">Modules</label>
        <select name="module" class="form-control" id="module" required>
            
        </select>
    </div>
    <div class="form-group">
        <label for="file">Files</label>
        <div class="custom-file">
            <input type="file" name="file[]" class="custom-file-input" id="file" accept=".gif, .jpg, .jpeg, .png, .rar, .pdf" multiple required>
            <label class="custom-file-label" for="file">Choose files</label>
        </div>
    </div>
    <button type="submit" name="submit" class="btn btn-primary"><i class="fas fa-check"></i> Validate</div>
</form>
<script>
    $(function(){
        $(".custom-file").parent("div").hide();
        $("#establishment").change(function(){
            var establishmentId = $(this).children("option:selected").val();
            $("#branch").html(null);
            if(parseInt(establishmentId) > 0) {
                $.get('<?= ROOT."branchs/jsonBranchsByEstablishment/" ?>'+establishmentId, function(data, status){
                    if(status == "success"){
                        let str = "<option value='0'></option>";
                        $.each(data,function(i,e){
                            str += "<option value='"+e.id+"'>"+e.Branch+"</option>"
                        });
                        $("#branch").html(str);
                    }
                });
            }
        });
        $("#branch").change(function(){
            getModules();
        });
        $("#semester").change(function(){
            getModules();
        });
        $("#module").change(function(){
            var selected = $(this).children("option:selected").val();
            if(parseInt(selected) > 0) $(".custom-file").parent("div").show(200);
            else $(".custom-file").parent("div").hide(200);
        });
        function getModules(){
            var branchId = parseInt($("#branch").children("option:selected").val());
            var semesterId = parseInt($("#semester").children("option:selected").val());
            $("#module").html(null);
            if(branchId > 0 && semesterId > 0){
                console.log(branchId,semesterId);
                $.get('<?= ROOT."modules/jsonModulesByBranchAndSemester/" ?>'+branchId+"/"+semesterId, function(data, status){
                    if(status == "success"){
                        let str = "<option value='0'></option>";
                        $.each(data,function(i,e){
                            str += "<option value='"+e.module_id+"'>"+e.module+"</option>"
                        });
                        $("#module").html(str);
                    }
                });
            }
        }
    });
</script>