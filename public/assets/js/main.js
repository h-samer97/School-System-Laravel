// // Delete Check box All

// document.addEventListener('DOMContentLoaded', function() {
//     const btnDeleteAll = document.getElementById('btn_delete_all');
    
//     if (btnDeleteAll) {
//         btnDeleteAll.addEventListener('click', function() {
//             const checkboxes = document.querySelectorAll('#datatable input[type=checkbox]:checked');
//             const selected = [];
            
//             checkboxes.forEach(function(checkbox) {
//                 selected.push(checkbox.value);
//             });
            
//             if (selected.length > 0) {
//                 const deleteAllModal = document.getElementById('delete_all');
//                 const deleteAllIdInput = document.querySelector('input[id="delete_all_id"]');
                
//                 if (deleteAllModal && deleteAllIdInput) {
                   
//                     deleteAllModal.style.display = 'block';
//                     deleteAllModal.classList.add('show');
                    
//                     deleteAllIdInput.value = selected.join(',');
//                 }
//             }
//         });
//     }
// });



    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#datatable input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });

            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });


    function CheckAll(element, chk){

        let allCheckBoxes = Array.from(document.querySelectorAll('#datatable .box1'));

        if(document.getElementById('example-select-all').checked == true) {
           allCheckBoxes.forEach(chechbox => {
                chechbox.checked = true;
           });
        } else {
            allCheckBoxes.forEach(chechbox => {
                chechbox.checked = false;
           });
        }

    }