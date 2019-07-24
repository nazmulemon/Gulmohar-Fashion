</div><br><br>

<div class="col-md-12 text-center" id="footer">Copyright &copy; Beautyglamour.com 2017</div>

<script>

    function updateSizes(){
      var sizeString = '';
      for(var i = 1; i <= 12; i++){
        if(jQuery('#size'+i).val() != ''){
          sizeString += jQuery('#size'+i).val()+':'+jQuery('#qty'+i).val()+',';
        }
      }
      jQuery('#sizes').val(sizeString);
    }

    function get_child_options(selected){
      if(typeof selected === 'undefined'){
        var selected = '';
      }
        var parentID = jQuery('#parent').val();
        jQuery.ajax({
            url: '/shoptime/admin/parsers/child_categories.php',
            type: 'POST',
            data: {parentID : parentID, selected: selected},
            success: function (data) {
                jQuery('#child').html(data);
            },
            error: function(){
                    alert("Something wrong with the child options")
                },
        });
    }
    jQuery('select[name="parent"]').change(function(){
      get_child_options();
    });


</script>
</body>
</html>
