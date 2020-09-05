<style>
  #loader-wrapper {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1000;
    background-color: rgba(84,36,55,0.3);
  }

  #loader {
    display: block;
    position: relative;
    left: 50%;
    top: 50%;
    width: 150px;
    height: 150px;
    margin: -75px 0 0 -75px;
    border-radius: 50%;
    z-index: 1001;
    animation: spin 2s linear infinite;
  }

  /*#loader-wrapper .loader-section {
    position: fixed;
    top: 0;
    width: 51%;
    height: 100%;
    background-color: lightgray;
  
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
    background-blend-mode: multiply;
    z-index: 1000;
    transform: translateX(0);
  }*/

  #loader-wrapper .loader-section.section-left {
    left: 0;
  }

  #loader-wrapper .loader-section.section-right {
    right: 0;
  }

  #loader {
    display: block;
    width: 100px;
    height: 100px;
    margin: 50 auto;
  }

  .circ-one {
    position: relative;
    display: block;
    width: 50px;
    height: 50px;
    background: rgba(217,91,67,1);
    border-radius: 100%;
    float: left;
    animation: load-x 1s cubic-bezier(0.445, 0.100, 0.550, 0.900) infinite;
  }

  .circ-two {
    position: relative;
    display: block;
    width: 50px;
    height: 50px;
    background: rgba(84,36,55,1);
    border-radius: 100%;
    float: right;
    animation: load-y 1s cubic-bezier(0.445, 0.100, 0.550, 0.900) infinite;
  }

  @keyframes load-x {
    0%   { left: -10px; transform: scale(1); }
    25%  { transform: scale(1.5); z-index: 2; }
    50%  { left: 60px; transform: scale(1); }
    75%  { transform: scale(0.5); z-index: 1; }
    100% { left: -10px; transform: scale(1); }
  }

  @keyframes load-y {
    0%   { right: -10px; transform: scale(1); }
    25%  { transform: scale(0.5); }
    50%  { right: 60px; transform: scale(1); z-index: 1; }
    75%  { transform: scale(1.5); z-index: 2; }
    100% { right: -10px; transform: scale(1); }
  }

  #loader p {
    text-align: center;
    font-family: 'Hanna', serif;
    font-weight: 50;
    color:rgba(192,41,66,1);
    animation: pulse 2s ease-in-out infinite;
  }

  @keyframes pulse {
    50% { opacity: 0.5; }
  }
  .loaded #loader-wrapper .loader-section.section-left {
    transform: translateY(-100%);
    transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
  }

  .loaded #loader-wrapper .loader-section.section-right {
    transform: translateY(100%);
    transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
  }

  .loaded #loader {
    opacity: 0;
    transition: all 0.3s ease-out;
  }

  .loaded #loader-wrapper {
    visibility: hidden;
    transition: all 0.1s 0.1s ease-out;
  }

  [class*="entypo-"]:before {
    font-family: 'entypo', sans-serif;
  }

  * {
    box-sizing: border-box;
  }

  .preload * {
    transition: none !important;
  }

</style>
<div class="wrapper">
  <div id="loader-wrapper">
    <div id="loader">
      <p>LOADING</p>
      <div class="circ-one"></div>
      <div class="circ-two"></div>
    </div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
  </div>
</div>
<div id="tree">

</div>
<script>
  $(function () {
    $("#btn-sync").show();
    $("#btn-sync").click(async function(){
      $(this).attr("disabled","disabled").addClass("disabled");
      $(this).find('i').addClass('fa-spin');
      localStorage.removeItem('treeInfo');
      await exec();
      $(this).removeAttr("disabled").removeClass("disabled");
      $(this).find('i').removeClass('fa-spin');
      setTimeout(function(){
        location.reload();
      },1000);
    });
    exec();
    async function exec() {
      try {
        let json = [];
        if(localStorage.getItem('treeInfo')) json = JSON.parse(localStorage.getItem('treeInfo'));
        else json = await getJsonData();
        $('#tree').bstreeview({ data: JSON.stringify(json) });
        $('.wrapper').addClass('loaded');
      } catch(err) {
        console.error(err);
      }
    }
    async function getJsonData(){
      let json = [];
      const establishments = await getData('select * from establishment');
      for(let i=0;i<establishments.length;i++){
        let establishment = {text:establishments[i].name,icon:'fas fa-university'};
        const branchs = await getData('SELECT b.* FROM branch b, lineBranch lb WHERE b.id = lb.branch_id and lb.establishment_id = '+establishments[i].id);
        if(branchs.length > 0){
          establishment.nodes = [];
          for(let j=0;j<branchs.length;j++){
            let branch = {text:branchs[j].name,icon:'fas fa-code-branch'};
            branch.nodes = [];
            for(let s=1;s<5;s++){
              let semester = {text:'Semester '+s,icon:'fas fa-graduation-cap'};
              const unities = await getData('SELECT distinct unity,unity_id FROM modules WHERE semester_id = '+s+' AND branch_id = '+branchs[j].id+' order by unity_id');
              if(unities.length > 0){
                semester.nodes = [];
                for(let u=0;u<unities.length;u++){
                  let unity = {text:unities[u].unity,icon:'fab fa-unity'};
                  const modules = await getData('SELECT * FROM modules WHERE semester_id = '+s+' AND unity_id = '+unities[u].unity_id+' AND branch_id = '+branchs[j].id+' order by module_id');
                  if(modules.length > 0){
                    unity.nodes = [];
                    for(let a=0;a<modules.length;a++){
                      let module = {text:modules[a].module,icon:'fab fa-leanpub'};
                      unity.nodes.push(module);
                    }
                  }
                  semester.nodes.push(unity);
                }
              }
              branch.nodes.push(semester);
            }
            establishment.nodes.push(branch);
          }
        }
        json.push(establishment);
      }
      localStorage.setItem('treeInfo', JSON.stringify(json)); 
      return json;
    }
    function getData(query) {
      let req = {query:query}; 
      return $.ajax({
        url: '<?= ROOT."home/jsonInfos" ?>',
        type: 'POST',
        data : req
      });
    };
  });
</script>