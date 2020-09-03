<form method="POST" id="form" style="height:100% !important;max-width:400px;margin:auto;" enctype="multipart/form-data">
    <div style="max-width: 200px;max-height:200px;" class="m-auto">
        <img src='<?=WEBROOT."img/upload.png" ?>' alt="users" class="w-100 h-100">
    </div>
    <div style="width:100%;margin:auto;"><?= Notify::getHTML(); ?></div>
    <div class="form-group">
        <label for="branch">Branch</label>
        <select name="branch" id="branch" required style="width:100%;">
            <?php foreach($branchs as $k=>$v){ ?>
            <option value="<?= $v["id"] ?>"><?= $v["name"] ?></option>
            <?php } ?>
        </select>
    </div>
    <div class="form-group">
        <label for="module">Module by semester</label>
        <select name="module" id="module" required style="width:100%;">
            
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
        $('#branch').multipleSelect({
            filter: true,
            filterGroup: true,
            onClick: function (view) {
                if(view.selected === true) refreshModules();
            },
        });
        refreshModules();
        function refreshModules(){
            let v = parseInt($('#branch').multipleSelect('getSelects')[0]);
            if(v<=0) return ;
            $select = $("#module");
            $select.multipleSelect('destroy');
            $select.html(null);
            $select.multipleSelect({
                filter: true,
                filterGroup: true
            });
            $.get('<?= ROOT."modules/jsonModulesByBranch/" ?>'+v,function(data,status){
                if(status === "success"){
                    var x = {};
                    for (var i = 0; i < data.length; ++i) {
                        var obj = data[i];
                        let key = obj.module;
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
                                text: "S "+e1.semester
                            });
                            $optGrp.append($opt);
                        });
                        $select.append($optGrp).multipleSelect('refresh');
                    });
                }
            });
        }
    });
</script>