$("#file").change(function () {
    $("#contentToUpload").html("");
    for (i=0;i<$("#file")[0].files.length;i++){
        console.log($("#file")[0].files[i].name);
        $("#contentToUpload").append($("#file")[0].files[i].name+"<br>");
    }
});