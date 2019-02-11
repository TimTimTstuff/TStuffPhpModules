<style>
    #api{
        border:solid thin gray;
        min-height: 60px;
    }
</style>
<h1>Web-Api Output</h1>
<div id="api">

</div>

<script>
    $.ajax({
        type:'PUT',
        url:"api/start.php",
        data:JSON.stringify({a:"test",b:12}),
        success:function(d){
            $("#api").text(JSON.stringify(d));
        },
        contentType:"application/json; charset=UTF-8",
        dataType:"json",
        error:function(err){
            $("#api").text(err);
        }
    });
</script>
