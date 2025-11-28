function checkdelete(event) {
    let c = confirm('Are You Sure?');
    if (!c) {
        event.preventDefault();
    }
    return c;
}

document.addEventListener('DOMContentLoaded', function () {
    const list = document.querySelectorAll(".delrem"); !

        list.forEach(item => {
            item.addEventListener('click', checkdelete);
        });
});

