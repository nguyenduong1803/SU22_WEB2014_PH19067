const $ = document.querySelector.bind(document);
const $$ = document.querySelectorAll.bind(document);


function toggle() {
    const form1 = $('.form1');
    const form2 = $('.form-forgot');
    const forgot = $('.forgot-link');
    const btnLogin = $('.btn__login');
    if (forgot) {
        forgot.onclick = (e) => {
            e.preventDefault();
            form1.classList.add('form-dis');
            form2.classList.remove('form-dis');
        }

    }
    if (btnLogin) {
        btnLogin.onclick = () => {
            form1.classList.remove('form-dis')
            form2.classList.add('form-dis')

        }

    }


}
function alerts() {
    const btns = $$('.btn--remove');
    if (btns) {
        btns.forEach(btn => {
            btn.onclick = e => {
                const isSucssec = confirm('Bạn có muốn xóa Sản Phẩm');
                if (isSucssec) {
                } else {
                    e.preventDefault();
                }
            }
        });
    }
}
function start() {
    getTime();
    alerts();
    toggle();
}
function getTime() {
    console.log("getTime");
    var countDownDate = new Date("July 19, 2022 00:00:00").getTime();
    // Update the count down every 1 second
    var x = setInterval(function () {
        // Get today's date and time
        var now = new Date().getTime();
        // Find the distance between now and the count down date
        var distance = countDownDate - now;
        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Display the result in the element with id="demo"
        // console.log(seconds);
        // document.querySelector(".time").innerHTML = days + 'day' +
        //     hours + "h " + minutes + "m " + seconds + "s ";
        if ($('.time-day') && $('.time-hour') && $('.time-minutes') && $('.time-seconds')) {
            $('.time-day').innerHTML = `<span>  ${days} </span><p> Ngày</p> `
            $('.time-hour').innerHTML = `<span>  ${hours} </span><p> Giờ</p> `
            $('.time-minutes').innerHTML = `<span> ${minutes} </span><p>Phút</p>  `
            $('.time-seconds').innerHTML = `<span>  ${seconds} </span><p>Giây</p>`

        } if (distance < 0) {
            clearInterval(x);
            document.querySelector(".time").innerHTML = "Hết thời gian";
        }
    }, 1000);
}


start();