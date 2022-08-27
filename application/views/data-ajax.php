<div class="container mt-5">
     <table id="example" class="table table-striped" style="width:100%">
          <thead>
               <tr>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Office</th>
                    <th>Age</th>
                    <th>Start date</th>
                    <th>Salary</th>
               </tr>
          </thead>
     </table>
</div>
<script>
     $((function() {
          $("#example").DataTable({
               dom: 'Bfrtip',
               buttons: ['excel', 'pdf', 'print'],
               bAutoWidth: !1,
               ordering: !1,
               processing: !0,
               ajax: {
                    url: "<?= base_url('home/dataAjax') ?>",
                    type: "POST"
               },
          })
     }))
</script>