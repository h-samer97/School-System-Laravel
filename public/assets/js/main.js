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


// document.addEventListener('DOMContentLoaded', () => {

//     const gradeSelect = document.querySelector('select[name="Grade_id"]');
//     const classSelect = document.querySelector('select[name="Class_id"]');

//     if(gradeSelect) {

//         gradeSelect.addEventListener('change', () => {

//            let gradeID = Number(gradeSelect.value);
           
//            if(gradeID) {
//                 fetch('Classes/' + gradeID).then(response => {
                    
//                     if(!response.ok) {
//                         throw new Error('Network response was not ok');
//                     }

//                     return response.json();

//                 }).then(
//                     data => {
//                         classSelect.innerHTML = '<option value="">اختر الصف...</option>';
//                         for (const [id, name] of Object.entries(data)) {
//                             let option = document.createElement('option');
//                             option.value = id;
//                             option.text = name;
//                             classSelect.appendChild(option);
//                         }
//                     }
//                 ).catch(error => console.error('Error:', error));
//            }

//         });

//     }

// });

function formStudentsAjax() {

   document.addEventListener('DOMContentLoaded', function () {
    const gradeSelect = document.querySelector('select[name="Grade_id"]');
    const classroomSelect = document.querySelector('select[name="Classroom_id"]');

    gradeSelect.addEventListener('change', async function () {
        const gradeId = this.value;

        if (!gradeId) {
            console.log('AJAX load did not work');
            return;
        }
        classroomSelect.innerHTML = '';

        try {
           
            const response = await fetch(`${window.location.origin}/Get_classrooms/${gradeId}`);
            const data = await response.json();


            const defaultOption = document.createElement('option');
            defaultOption.textContent = `Choose here . . . `;
            defaultOption.disabled = true;
            defaultOption.selected = true;
            classroomSelect.appendChild(defaultOption);

            for (const [key, value] of Object.entries(data)) {
                const option = document.createElement('option');
                option.value = key;
                option.textContent = value;
                classroomSelect.appendChild(option);
            }

        } catch (error) {
            console.error('AJAX error:', error);
        }
    });
  });
}



// function formSectionsAjax() {

// document.addEventListener('DOMContentLoaded', function () {
//     const classroomSelect = document.querySelector('select[name="Classroom_id"]');
//     const sectionSelect = document.querySelector('select[name="section_id"]');

//     classroomSelect.addEventListener('change', async function () {
//         const classroomId = this.value;

//         if (!classroomId) {
//             console.log('AJAX load did not work');
//             return;
//         }

//         try {
//             const response = await fetch(`${window.location.origin}/Get_Sections/${classroomId}`);
//             const data = await response.json();

//             sectionSelect.innerHTML = '';

//             for (const [key, value] of Object.entries(data)) {
//                 const option = document.createElement('option');
//                 option.value = key;
//                 option.textContent = value;
//                 sectionSelect.appendChild(option);
//             }

//         } catch (error) {
//             console.error('AJAX error:', error);
//         }
//     });
// });
// }
// // =====================================================================================
// function formNewClassroomsAjax() {

//     const newClassroomSelect = document.querySelector('select[name="Classroom_id_new"]');
//     const newSectionSelect = document.querySelector('select[name="section_id_new"]');

//     newClassroomSelect.addEventListener('change', async function () {
//         const newClassroomSValue = newClassroomSelect.value;

//         if (!newClassroomSValue) {
//             console.log('AJAX load did not work');
//             return;
//         }
//         newSectionSelect.innerHTML = '';

//         try {
//             const response = await fetch('Get_Get_Sections/' + newClassroomSValue);
//             const data = await response.json();


//             for (const [key, value] of Object.entries(data)) {
//                 const option = document.createElement('option');
//                 option.value = key;
//                 option.textContent = value;
//                 newSectionSelect.appendChild(option);
//             }

//         } catch (error) {
//             console.error('AJAX error:', error);
//         }
//     });
// };



// function getClassroomPromotions() {

//     const grade = document.querySelector('#selectFormPromotionOld');
//     const classrooms = document.querySelector('#selectFormPromotionOldClassrooms');

//     grade.addEventListener('change', async () => {
        
//         const gradeID = grade.value;

//         if(!gradeID) {
//             console.error('Invalid ID Grade');
//             return;
//         }

//         classrooms.innerHTML = "";
//         try {
//             const response = await fetch('/getClassroomsInPormotions/' + gradeID);
//             const data = await response.json();


//         for(const [key, value] of Object.entries(data)) {
//             const option = document.createElement('option');
//             option.textContent = value;
//             option.value = key;
//             classrooms.appendChild(option);
//         }

//         } catch(error) {
//             throw new Error(error);
//         }

//     });
// }






async function dynamicLoader(triggerSelector, targetSelector, apiUrl) {
        const trigger = document.querySelector(triggerSelector);
        const target = document.querySelector(targetSelector);

        if (!trigger || !target) return;

        trigger.addEventListener('change', async function () {
            const id = this.value;
            
            target.innerHTML = '<option value="">جاري التحميل...</option>';

            if (!id) {
                target.innerHTML = '<option value="">اختيار...</option>';
                return;
            }

            try {
                const response = await fetch(`${window.location.origin}/${apiUrl}/${id}`);
                if (!response.ok) throw new Error('Network response was not ok');
                
                const data = await response.json();

                // تصفير القائمة وتجهيزها للبيانات الجديدة
                target.innerHTML = '<option selected disabled>اختيار...</option>';

                if (Object.keys(data).length === 0) {
                    target.innerHTML = '<option disabled>لا توجد بيانات متاحة</option>';
                } else {
                    for (const [key, value] of Object.entries(data)) {
                        const option = document.createElement('option');
                        option.value = key;
                        option.textContent = value;
                        target.appendChild(option);
                    }
                }
            } catch (error) {
                console.error('AJAX Error:', error);
                target.innerHTML = '<option disabled>حدث خطأ أثناء التحميل</option>';
            }
        });
    }

    // تشغيل العمليات عند تحميل المستند
    document.addEventListener('DOMContentLoaded', function () {
        
        // --- أولاً: المرحلة الدراسية القديمة (Old Grade Section) ---
        // جلب الصفوف بناءً على المرحلة القديمة
        dynamicLoader('select[name="Grade_id"]', 'select[name="Classroom_id"]', 'Get_classrooms');
        
        // جلب الأقسام بناءً على الصف القديم
        dynamicLoader('select[name="Classroom_id"]', 'select[name="section_id"]', 'Get_Sections');


        // --- ثانياً: المرحلة الدراسية الجديدة (New Grade Section) ---
        // جلب الصفوف بناءً على المرحلة الجديدة
        dynamicLoader('select[name="Grade_id_new"]', 'select[name="Classroom_id_new"]', 'Get_classrooms');
        
        // جلب الأقسام بناءً على الصف الجديد
        dynamicLoader('select[name="Classroom_id_new"]', 'select[name="section_id_new"]', 'Get_Sections');

    });