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

    prod = document.getElementById("producer_id");
    if (prod) {
        prod.addEventListener('change', function () {
            pid = prod.value;
            document.getElementById("model_id").value = "";
            const list = document.querySelectorAll(".mdpd");
            if (list.length > 0) {
                list.forEach(item => {
                    item.style.display = "none";
                });
            }
            const listchange = document.querySelectorAll(".model" + pid);
            if (listchange.length > 0) {
                listchange.forEach(item => {
                    item.style.display = "block";
                });
            }
        });
    }

    const eqs = document.querySelectorAll(".eq");
    if (eqs) {
        eqs.forEach(item => {
            item.addEventListener('change', function () {
                console.log(item)
                const id = item.getAttribute("data-id");
                const ch = item.checked;
                if (ch) {
                    document.getElementById("eqval" + id).style.display = "block";
                } else {
                    document.getElementById("eqval" + id).value = "";
                    document.getElementById("eqval" + id).style.display = "none";
                }

            });
        });
    }


});




