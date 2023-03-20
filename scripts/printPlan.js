
window.addEventListener("load", print_plan);

function print_plan(){
    let print_plan_button = document.getElementById('printPlan');
    print_plan_button.addEventListener("click", function (){
        let token = print_plan_button.firstElementChild.id;
        print(token);

        // printWin.document.write(print_plan.outerText);
        // printWin.print();
        // printWin.close();
    })
}
//print form on page
function print(token) {

    let printForm = window.open(token, "plan");

    // Wait for page to load before printing
    $($(printForm).on('load', function() { // SOURCE: https://stackoverflow.com/questions/6460630/close-window-automatically-after-printing-dialog-closes#:~:text=open()%3B%20...-,window.,and%20close()%20the%20window.
            printForm.onafterprint = window.close;
            printForm.print();
        })
    );
}


