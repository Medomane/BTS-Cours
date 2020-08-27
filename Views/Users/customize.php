<table class="table table-striped table-bordered table-sm">
    <thead>
        <tr class="filters">
            <th>First name</th>
            <th>Last name</th>
            <th>Email</th>
            <th>Date</th>
            <th>Type</th>
            <th>Gender</th>
            <th>#</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($users as $k => $v){ ?>
            <tr>
                <td><?= $v["firstName"] ?></td>
                <td><?= $v["lastName"] ?></td>
                <td><?= $v["email"] ?></td>
                <td><?= $v["registredAt"] ?></td>
                <td><?= $v["type"] ?></td>
                <td><?= intval($v["gender"])==0?"Male":"Femal" ?></td>
                <td style="width:97px;">
                    <div onclick="editFile('<?= ROOT.'users/activated/'.$v['id'] ?>',$(this))" class="btn btn-light" title="<?= intval($v["activated"])==0?'Activate':'Deactivate'?>"><i class="fa <?= intval($v["activated"])==0?'fa-check-circle':'fa-minus-circle'?>"></i></div>
                    <div onclick="editFile('<?= ROOT.'users/delete/'.$v['id'] ?>',$(this))" class="btn btn-danger" title="Delete"><i class="fa fa-trash-alt"></i></div>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>
<script>
    function editFile(url,t){
        if(url.indexOf("delete") !== -1){
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
                            let tr = t.parent("td").parent("tr");
                            tr.hide(300,function(){
                                tr.remove();
                            });
                        }
                    });
                }
            });
        }
        else{
            $.get(url,function(data,status){
                if(status === "success"){
                    let tr = t.parent("td").parent("tr");
                    tr.hide(300,function(){
                        tr.remove();
                    });
                }
            });
        }
    }
</script>