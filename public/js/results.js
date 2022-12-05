var result = 0;
async function nextResult(){
    const results_array = document.querySelectorAll(".data");
    const background_array = document.querySelectorAll(".background > img");
    const details_array = document.querySelectorAll(".results-map");
    var results = [...results_array];
    var backgrounds = [...background_array];
    var details = [...details_array];
    results[result].setAttribute("id", "not-active");
    backgrounds[result].setAttribute("id", "not-active");
    details[result].setAttribute("id", "not-active");
    result = result + 1;
    if(result >= results.length)
        result = 0;
    results[result].setAttribute("id", "active");
    backgrounds[result].setAttribute("id", "active-bcg");
    details[result].setAttribute("id", "active");
}
function delay(milliseconds){
    return new Promise(resolve => {
        setTimeout(resolve, milliseconds);
    });
}
document.querySelectorAll(".input").disabled = true;
