const $ = document.querySelector.bind(document)
const $$ = document.querySelectorAll.bind(document)

function choice() {
    const manClock = $('.manClock')
    const femanClock = $('.femanClock')
    const phuKienP = $('.phuKien')
    const man = $('.man-seller')
    const feman = $('.feman-seller')
    const phuKien = $('.item-seller')
    manClock.onclick = function (e) {
        man.style.display = "block"
        feman.style.display = "none"
        phuKien.style.display = "none"
        manClock.classList.add('active')
        femanClock.classList.remove('active')
        phuKienP.classList.remove('active')

    }
    femanClock.onclick = function () {
        manClock.classList.remove('active')
        femanClock.classList.add('active')
        phuKienP.classList.remove('active')
        feman.style.display = "block"
        man.style.display = "none"
        phuKien.style.display = "none"
    }
    phuKienP.onclick = function (e) {
        phuKienP.classList.add('active')
        manClock.classList.remove('active')
        femanClock.classList.remove('active')
        phuKien.style.display = "block"
        feman.style.display = "none"
        man.style.display = "none"
    }
}
function hover(){
    const down = $('.caret-down');
    const products = $('.products');
    console.log(down);
    console.log(products);
    products.onmouseover =function(){
        down.style.animation="xoay 1s ease";
    }
    products.onmouseout =function(){
        down.style.animation="tron 1s ease";
    }

}
function render(inner, j, api, m = 0) {
    fetch(api)
        .then((respone) => respone.json())
        .then((clock) => {
            
            if (m != 0) {
                m = Math.ceil(clock.length / 2);
                j = m + 4;
                if (m < 4) {
                    m = 4;
                    j = clock.length;
                }
            }
            console.log(clock.length);
            const html = clock.map((c, index) => {
                let sales = 0
                let minusPrice = 0
                let price1 = 0
                if (Number(c.sale) > 0) {
                    sales = `-${c.sale}%`
                    minusPrice = c.price - ((c.price * c.sale) / 100)
                    price1 = `${c.price.toLocaleString()}<u>đ</u>`
                } else {
                    sales = ''
                    minusPrice = c.price
                    price1 = ''
                }

                if (index >= m && index < j) {
                    return `
                <ul class="seller-item">
                <li><img id="${api}" src="${c.img}" alt=""> </li>
                <h2 id="${index}">${c.name}</h2>
                <span class="minusPrice">${price1}</span>  <p class="money">${minusPrice.toLocaleString()}<u>đ</u></p>
                <ion-icon class="show"  name="eye-outline"></ion-icon>
                <ion-icon class="add-cart" name="cart-outline"></ion-icon>
                   <span class="sale">${sales}</span>
            </ul>
                `
                }
            });
            $(inner).innerHTML = html.join('')
            const shows = $$('.show')
            const details = $('.details')
            let i;
            Array.from(shows).forEach((show, index) => {
                let price1 = 0;
                show.onclick = function () {
                    const seller = $$('.seller-item')
                    const api = seller[index].querySelector(' img').id
                    details.style.display = 'block'
                    return fetch(api)
                        .then((respone) => respone.json())
                        .then((clock2) => {
                            showDetail(clock2, show);
                            DetailImg(clock2, show);
                            renderTable();
                            quantity();
                        })
                }
            })
        })
}
//hiện bảng thông tin sp
const ArrCart = []

function showDetail(clock2, show) {
    let Cart = {};
    i = Number(show.parentElement.querySelector('h2').id)
    const htmls = clock2.map((c, index) => {
        if (Number(c.sale) > 0) {
            sales = `-${c.sale}%`
            minusPrice = c.price - ((c.price * c.sale) / 100)
            price1 = `${c.price.toLocaleString()}<u>đ</u>`
        } else {
            sales = ''
            minusPrice = c.price
            price1 = ''
        }
        if (index === i) {
            c.minusPrice = minusPrice
            Cart = c;
            return `
<div class="detail__product">
<ion-icon class="details__close" name="close-outline"></ion-icon>
<div class="detail__img">
    <div class="detail__bigImg">
        <img src="${c.img}" alt="">
    </div>
    <div class="detail__imgMini">
           
    </div>
    <div class="nextPrev">
    <ion-icon class="prev" name="chevron-back-outline"></ion-icon>
    <ion-icon class="next" name="chevron-forward-outline"></ion-icon>
    </div>
</div>
<div class="detail__text">
    <h2>${c.name}</h2>
    <span>Thương hiệu: đang cập nhật</span><span class="space">|</span>
    <span>Mã sản phẩm: Đang cập nhật</span>
    <span class="minusPrice size20 ">${price1}<u>đ</u></span>
    <p class="money size20">${minusPrice.toLocaleString()}<u>đ</u></p>
    <div class="detail__quantity">
        <span class="size13">Số lượng: </span>
        <div class="detail__s">
            <ion-icon class="minus" name="remove-outline"></ion-icon>
            <span class="num">1</span>
            <ion-icon class="plus" name="add-outline"></ion-icon>
        </div>
    </div>
    <button class="addProduct">Thêm vào sản phẩm</button>
</div>
</div>
`
        }
    })
    $('.details').innerHTML = htmls.join('')
    //Thêm sản phẩm vào cart
    const addProduct = $('.addProduct')
    addProduct.onclick = function () {
        const quantity = $('.detail__s .num').innerHTML
        Cart.quantity = quantity
        ArrCart.push(Cart)
        const htmlCart = ArrCart.map((c, index) => {
            if (index < 4) {
                return `
            <div class="showCart">
            <img src="${c.img}" alt="">
            <div> <p>${c.name}</p>
                    <p class="money">${c.minusPrice.toLocaleString()}đ</p>
            </div 
            <p class="Cart-quantity">x${c.quantity}</p>
        </div>  
        `
            }
        })

      

        const tong = ArrCart.reduce((money, value, index) => {
            if (index < 4) {
                money += value.minusPrice * value.quantity
            }
            return money
        }, 0)
        $('.cart-item').innerHTML = htmlCart.join('') + `<p>Tạm tính: <span class="money"> ${tong.toLocaleString()}đ</span></p>
                                                        <button class="" id="showCart">Xem giỏ hàng</button>`
     
        const details = $('.details')
        details.style.display = 'none'
        $('.sussec').classList.add('actives');
        setTimeout(() => {
            $('.sussec').classList.remove('actives');
        }, 800);
    }


}
//hiển thị lên bảng 
function renderTable(){
    const price = ArrCart.map((c, index) => {
        const tong = c.quantity * c.minusPrice
        return ` 
        <tr>          
            <td class="img-price"><img src="${c.img}" alt=""></td>
            <td>${c.name}</td>
            <td>${c.minusPrice.toLocaleString()}</td>
            <td> <div class="detail__quantity">
          
            <div class="detail__s">
                <ion-icon class="minus" name="remove-outline"></ion-icon>
                <span class="num">1</span>
                <ion-icon class="plus" name="add-outline"></ion-icon>
            </div>
        </div></td>
            <td>${tong}</td>
            <td class="delete-price">Xóa</td>
            
      </tr>`
    })
    $('.price-clock').innerHTML=price.join('');
}
//hiện hình ảnh phụ bên dưới
function DetailImg(clock, show) {
    let i = Number(show.parentElement.querySelector('h2').id)
    clock.map((c, index) => {
        if (index === i) {
            renderMiniImg(0, 4)
            const next = $('.next');
            const prev = $('.prev');
            let n = 0;
            let j = 4;
            onmouseShowImg()
            next.onclick = function () {
                if (j < c.imgDetail.length) {
                    n++;
                    j++;
                }
                console.log(n, j);
                renderMiniImg(n, j)
                onmouseShowImg()
            }
            prev.onclick = function () {
                if (n > 0) {
                    n--;
                    j--;
                }
                console.log(n, j);
                renderMiniImg(n, j)
                onmouseShowImg()
            }
        }
        function onmouseShowImg() {
            const miniImg = $$('.detail__imgMini img')
            const bigImg = $('.detail__bigImg img')
            Array.from(miniImg).forEach((m) => {
                m.onmouseover = function () {
                    if (bigImg.src != m.src) {
                        bigImg.src = m.src
                        m.classList.add('active')
                    }
                }
                m.onmouseout = function () {
                    m.classList.remove('active')
                }
            })
        }

        function renderMiniImg(n, j) {

            const html = c.imgDetail.map((c2, indexs) => {
                if (indexs >= n && indexs < j) {
                    return `
                  <img src="${c2}" alt=""> `
                }
            })
            $('.detail__imgMini').innerHTML = html.join('')
        }
    })
}

function getTime() {
    var countDownDate = new Date("Mar 12, 2022 00:00:00").getTime();
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
        $('.time-day').innerHTML = `<span>  ${days} </span><p> Ngày</p> `
        $('.time-hour').innerHTML = `<span>  ${hours} </span><p> Giờ</p> `
        $('.time-minutes').innerHTML = `<span> ${minutes} </span><p>Phút</p>  `
        $('.time-seconds').innerHTML = `<span>  ${seconds} </span><p>Giây</p>`
        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.querySelector(".time").innerHTML = "Hết thời gian";
        }
    }, 1000);
}

// cộng trừ số lượng 
function quantity() {
    const minus = $('.minus')
    const plus = $('.plus')
    const num = $('.num')
    minus.onclick = function () {
        if (Number(num.innerText) > 1) {
            let so = Number(num.innerText - 1)
            num.innerText = so
        }
    }
    plus.onclick = function () {
        let so = Number(num.innerText) + 1
        num.innerText = so
    }
    const details = $('.details')
    const close = $('.details__close')
    close.onclick = function () {
        details.style.display = 'none'
    }
}
//form đăng kí
function Register() {
    const register = $('.register')
    const login = $('.onlogin')
    const close = $('.close__regis');
    register.onclick = function (e) {
        e.preventDefault();
        $('.formRegister').classList.add("active")
        close.onclick = function () {
            $('.formRegister').classList.remove("active")
        }
        Validator();
    }
    login.onclick = function (e) {
        e.preventDefault();
        console.log(login);
    }
}

function Validator() {
    const fullname = $('#fullname')
    const password = $('#password')
    const email = $('#emails')
    const form = $('#form')
    const man = $("#man")
    const feman = $("#feman")
    const errMess = $$(".errMess")


    const arrTour = []
    form.onsubmit = function (e) {
        const obj = {}
        e.preventDefault();
        if (!fullname.value) {
            message(fullname, 'Vui lòng nhập dữ liệu')
        } else if (fullname.value.length < 6 || fullname.value.length > 13) {
            message(fullname, 'Nhập tên lớn hơn 6 kí tự và nhỏ hơn 16 kí tự')
        } else {
            message(fullname, '')
            obj.fullname = fullname.value
        }

        if (!password.value) {
            message(password, 'Vui lòng nhập dữ liệu')
        } else if (password.value.length < 5) {
            message(password, 'Vui lòng nhập mật khẩu lớn hơn 5 kí tự')

        } else {
            message(password, '')
            obj.password = password.value
        }

        if (!email.value) {
            message(email, 'Vui lòng nhập dữ liệu')
        } else {
            message(email, '')
            obj.email = email.value
        }


        if (man.checked || feman.checked) {
            man.parentElement.querySelector('.errMess').innerHTML = ''
            if (man.checked) {
                obj.gender = man.value
            } else {
                obj.gender = feman.value
            }
        } else {
            man.parentElement.querySelector('.errMess').innerHTML = 'Vui lòng nhập dữ liệu'
        }
        const result = Array.from(errMess).every((err => {
            return err.innerHTML === ""
        }))
        if (result) {
            console.log('thành công');
            $('.login').innerHTML = `<div class="hello">xin chào <br>
                                      ${obj.fullname} 
                                        <div class="hoverName">
                                            <ul><li class="border-bottom">Tài khoản</li>
                                                 <li class="border-bottom">Đơn mua</li>
                                                 <li>Đăng xuất</li>
                                            </ul>
                                        </div>
                                      </div>   `
            $('.formRegister').classList.remove("active")
        } else {
            console.log('Thất bại');
        }
        function message(input, mess) {
            input.parentElement.querySelector('.errMess').innerHTML = mess
        }

    }
}
function menu(){
    const menu = $(".btn__menu");
    console.log(menu);
    menu.onclick =function(e){
      $('.big-menu').classList.toggle('active');
    }
}
function start() {
    
    const ManApi = 'http://localhost:3000/product'
    const femalApi = 'http://localhost:3000/product-feman'
    const pkApi = 'http://localhost:3000/phuKien'
    // getTime();
    render('.phuKien-product', 4, pkApi);
    render('.phuKien-product2', 4, pkApi, 2);
    render('.man-products', 4, ManApi);
    render('.seller-product', 4, ManApi);
    render('.seller-product2', 4, ManApi, 2);
    render('.feman-render', 4, femalApi);
    render('.feman-product', 4, femalApi);
    render('.feman-product2', 4, femalApi, 2);
    choice();
    
    Register();
    menu();
   
    // quantity();
}

hover();
start();