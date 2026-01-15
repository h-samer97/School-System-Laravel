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

    // Sections Model


document.addEventListener('DOMContentLoaded', () => {

    const gradeSelect = document.querySelector('select[name="Grade_id"]');
    const classSelect = document.querySelector('select[name="Class_id"]');

    if(gradeSelect) {

        gradeSelect.addEventListener('change', () => {

           let gradeID = Number(gradeSelect.value);
           
           if(gradeID) {
                fetch('Classes/' + gradeID).then(response => {
                    
                    if(!response.ok) {
                        throw new Error('Network response was not ok');
                    }

                    return response.json();

                }).then(
                    data => {
                        classSelect.innerHTML = '<option value="">اختر الصف...</option>';
                        for (const [id, name] of Object.entries(data)) {
                            let option = document.createElement('option');
                            option.value = id;
                            option.text = name;
                            classSelect.appendChild(option);
                        }
                    }
                ).catch(error => console.error('Error:', error));
           }

        });

    }

});