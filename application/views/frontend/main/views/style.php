<style>
    @font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-Thin.ttf') format('truetype');
  font-weight: 100;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-ExtraLight.ttf') format('truetype');
  font-weight: 200;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-Light.ttf') format('truetype');
  font-weight: 300;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-Regular.ttf') format('truetype');
  font-weight: 400;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-Medium.ttf') format('truetype');
  font-weight: 500;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-SemiBold.ttf') format('truetype');
  font-weight: 600;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-Bold.ttf') format('truetype');
  font-weight: 700;
  font-style: normal;
}

@font-face {
  font-family: 'Sora';
  src: url('../fonts/Sora-ExtraBold.ttf') format('truetype');
  font-weight: 800;
  font-style: normal;
}



body {
  font-family: "Sora", sans-serif !important;
  font-optical-sizing: auto !important;
  font-style: normal !important;
  color: #0f1114 !important;
  font-size: 14px !important;
  font-weight: 400 !important;
}
.LL-Btn-Bordered{
    border:1px solid #3F8AEF !important;
    color: #3F8AEF !important;
    transition: all 0.3s ease-in-out;
}
.LL-Btn-Bordered:hover{
    background-color: #EEF5FF;
}
.LL-btn-Bg{
    background-color: #3F8AEF !important;
    color:  #fff !important;
    transition: all 0.3s ease-in-out;
}

.LL-btn-Bg:hover{
    background-color: #2877df !important;
}

.bolded-600{
    font-weight: 600 !important;
}

.margon-topGen{
    margin-top: 80px !important;
}


/*LLL_NavBar*/

.LLL_NavBar{
    position: fixed;
    width: 100%;
    height: 80px;
    z-index: 2000;
    display: flex;
    align-items: center;
    top: 0;
    left: 0;
    background-color: #fff;
     box-shadow: 0 0 10px rgb(0 0 0 / 5%);
            -webkit-box-shadow: 0 0 20px rgb(0 0 0 / 10%);
            -moz-box-shadow: 0 0 20px rgb(0 0 0 / 10%);
}



.LLLnav_Container{
    position: relative;
    width: 95%;
    margin-left: 2.5%;
    height: auto;
}



/*main_LL_Nav_Coint*/

.main_LL_Nav_Coint{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    gap: 10px;
}

.LLL_NAv_LOgols{
    position: relative;
}

.LLL_NAv_LOgols img{
    max-width: 80px;
}

.oayujs-Colaiks{
    position: relative;
    width: 100%;
    display: inline-flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
}

.oayujs-Colaiks-0{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 10px;
}
.oo1-oila{
    width: 100%;
}
.oayujs-Colaiks-0 ul{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;
}

.oayujs-Colaiks-0 ul li a{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 15px;
    border-radius: 4px;
    white-space: nowrap;
    height: 40px;
    justify-content: center;
    transition: all 0.3s ease-in-out;
    font-size:13px !important;
    
}
.oayujs-Colaiks-0 ul li i{
    font-size: 9px;
    margin-left: 2px;
}
.oayujs-Colaiks-0 ul li a img{
    width: 17px;
}
.oayujs-Colaiks-0 ul li a:hover{
    background-color: #EEF5FF;
    color: #3F8AEF;
}

.hovered-img{
    display: none;
}

.oayujs-Colaiks-0 ul li a:hover .unhover-img{
    display: none;
}
.oayujs-Colaiks-0 ul li a:hover .hovered-img{
    display: inline-flex !important;
}

.oayujs-Colaiks-0 ul li a span{
    position: absolute;
    top: -2px;
    right: 5px;
    width: 20px;
    height: 20px;
    border-radius: 50%;
    background-color: #F82B60;
    color: #fff;
    font-size: 9px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.oayujs-Colaiks-Search{
    position: relative;
    display: inline-flex;
    align-items: center;
    width: 100%;
}

.oayujs-Colaiks-Search input{
    position: relative;
    width: 100%;
    height: 45px;
    background: #fff;
    border:1px solid #dbe0e1;
    border-radius: 50px;
    padding: 0px 10px;
    padding-left: 50px;
    font-size: 13px;
    font-weight: 300 !important;
}

.oayujs-Colaiks-Search input:focus{
    border-width: 2px;
    border-color: #3F8AEF;
}

.oayujs-Colaiks-Search button{
    position: absolute;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    z-index: 10;
    left: 5px;
    font-size: 15px;
    cursor: pointer;
    background-color: transparent;
    transition: all 0.3s ease-in-out;
    color:#999b9e;
}

.oayujs-Colaiks-Search button:hover{
    background-color:#f0f6ff;
    color: #2a2b3f;
}




/* Gent-Coursess-Drop-Downn */

.Gent-Coursess-Drop-Downn{
    position: fixed;
    width: auto;
    max-width: 87%;
    height: auto;
    min-height: 400px;
    max-height: 700px;
    top: 60px;
    align-items: flex-start;
    border:1px solid #dbe0e1;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    -webkit-box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    -moz-box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius:8px;
    overflow: hidden;
    display: none;
    opacity: 0;
    transform: translateY(-10px);
    background-color: #fff;
}





.oayujs-Colaiks-0 ul li:hover .Gent-Coursess-Drop-Downn {
  display: flex;
  animation: fadeInDown 0.4s ease forwards;
  -webkit-animation: fadeInDown 0.4s ease forwards;
  -moz-animation: fadeInDown 0.4s ease forwards;
  visibility: visible;
}

@keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@-webkit-keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

@-moz-keyframes fadeInDown {
  from {
    opacity: 0;
    transform: translateY(-10px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}

.oayujs-Colaiks-0 ul li.explore-Lii:hover{
    color: #3F8AEF;
}

.oayujs-Colaiks-0 ul li.explore-Lii:hover a i{
    transform: rotate(180deg);
}

.oayujs-Colaiks-0 ul li.explore-Lii a i{
    transition: all 0.3s ease-in-out;
}

.Gen-Drop-Partt{
    position: relative;
    width: 300px;
    min-height: inherit;
    height: 550px;
    border-left:1px solid #dbe0e1;
    overflow: hidden;
}





.Gen-Drop-Partt:first-child{
    border-left: none !important;
}

.Gen-Drop-Partt h3{
    font-size: 13px;
    font-weight: 600;
    padding: 20px;
    padding-bottom: 10px !important;
    color: #303142 !important;
}

.Gen-Drop-Partt ul{
    position: relative;
    width: 100%;
    height: auto;
    display: flex !important;
    flex-direction: column !important;
    gap: 0px !important;
    max-height: 500px;
    overflow-y: auto;
}

.Gen-Drop-Partt ul li{
    width: 100% !important;
}

.Gen-Drop-Partt ul li a{
    position: relative !important;
    display: flex !important;
    padding: 8px 20px !important;
    justify-content: flex-start !important;
    border-radius: 0px !important;
    font-size: 12px !important;
    height: auto !important;
    color: #303142 !important;
    white-space: normal !important;
}



.Gen-Drop-Partt ul::-webkit-scrollbar {
    width: 5px; 
}

.Gen-Drop-Partt ul::-webkit-scrollbar-track {
    background: #EFF2F6; 
    border-radius: 30px;
}

.Gen-Drop-Partt ul::-webkit-scrollbar-thumb {
    background: #c1c5ce; 
     border-radius: 30px;
}

.Gen-Drop-Partt ul::-webkit-scrollbar-thumb:hover {
    background: #b1b5bf;
}
.Gen-Drop-Partt ul::-webkit-scrollbar-button:single-button:decrement {
    background-color: #EFF2F6;
    display: block;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black"><path d="M7 14l5-5 5 5z"/></svg>');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 15px;
    border-top-right-radius: 10px;
    border-top-left-radius: 10px;
}

.Gen-Drop-Partt ul::-webkit-scrollbar-button:single-button:increment {
    background:#EFF2F6;
    display: block;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="black"><path d="M7 10l5 5 5-5z"/></svg>');
    background-repeat: no-repeat;
    background-position: center;
    background-size: 15px;
    border-bottom-right-radius: 10px;
    border-bottom-left-radius: 10px;
}


.Gen-Drop-Partt ul li a.viewAll-Lii-A{
    color: #3F8AEF !important;
}



.LL-mobille-Gland,
.mobilw-Li-Hide-PC{
    display: none;
}


@media screen and (max-width:1200px){
     .LL-mobille-Gland{
        display: inline-flex !important;
        align-items: center;
        gap: 17px;
    }
     .LL-mobille-Gland button{
        position: relative;
        padding: 5px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        background-color: transparent;
        transition: all 0.3s ease-in-out;
        font-size: 16px;
    }


    .LL-mobile-toggle-nav{
        position: relative;
        width: 21px;
        height: 25px;
        display: inline-flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .LL-mobile-toggle-nav span{
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #2a2b3f;
        display: inline-flex;
        transition: all 0.3s ease-in-out;
    }

    .active-LL-NAv-Drop.LLL_NavBar .LL-mobile-toggle-nav span{
        background-color: transparent !important;
    }

    .active-LL-NAv-Drop.LLL_NavBar .LL-mobile-toggle-nav span::before{
        transform: rotate(45deg);
    }
     .active-LL-NAv-Drop.LLL_NavBar .LL-mobile-toggle-nav span::after{
        transform: rotate(-45deg);
    }

    .LL-mobile-toggle-nav span::before{
        content: '';
        position: absolute;
        width: 100%;
        height: inherit;
        background-color: #2a2b3f;
        transform: translateY(-7px);
         transition: all 0.3s ease-in-out;
    }

    .LL-mobile-toggle-nav span::after{
        content: '';
        position: absolute;
        width: 100%;
        height: inherit;
        background-color: #2a2b3f;
        transform: translateY(7px);
         transition: all 0.3s ease-in-out;
    }
    .margon-topGen{
    margin-top: 60px !important;
}

.mobb-Ahf{
    position: relative;
    padding: 5px;
}

.mobb-Ahf span{
    position: absolute;
    top: 0px;
    right: -5px;
    width: 17px;
    height: 17px;
    border-radius: 50%;
    background-color: #F82B60;
    color: #fff;
    font-size: 7px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.mobb-Ahf img{
    width: 15px;
}


.LLL_NavBar{
    height: 60px !important;
    border-bottom:1px solid transparent;
}

     .active-LL-NAv-Drop.LLL_NavBar{
            box-shadow: 0 0 10px rgb(0 0 0 / 5%);
            -webkit-box-shadow: 0 0 10px rgb(0 0 0 / 5%);
            -moz-box-shadow: 0 0 10px rgb(0 0 0 / 5%);
            border-color: #f0f4f5 !important;
            transition: all 0.3s ease-in-out;

     }

    .main_LL_Nav_Coint{
        justify-content: space-between !important;
    }

    .oayujs-Colaiks{
        position: fixed !important;
        width: 250px !important;
        height: 100% !important;
        top: 60px !important;
        right: -100% !important;
        background-color: #fff !important;
        box-shadow: -8px 0 8px -4px rgb(0 0 0 / 5%);
        -webkit-box-shadow: -8px 0 8px -4px rgb(0 0 0 / 5%);
        -moz-box-shadow: -8px 0 8px -4px rgb(0 0 0 / 5%);
        overflow-y: auto;
        padding: 20px;
        padding-bottom: 30px;
        display: block !important;
        border-left:1px solid #f0f4f5;
        transition: all 0.3s ease-in-out;
    }

    .active-LL-NAv-Drop.LLL_NavBar .oayujs-Colaiks{
        right: 0% !important;
    }

    .oayujs-Colaiks-0{
        display: block !important;
        width: 100% !important;
    }
    .oo1-oila{
        display: none !important;
    }
    .oayujs-Colaiks-0 ul{
        flex-direction: column !important;
        width: 100% !important;
    }

    .genn-Li-Cart{
        display: none !important;
    }
    

    .oayujs-Colaiks-0 ul li{
        width: 100% !important;
        margin-top: 5px !important;
    }
    .oayujs-Colaiks-0 ul li a{
        width: 100% !important;
        align-items: flex-start !important;
        justify-content: flex-start !important;
        height: auto !important;
        padding: 10px 0px !important;
    }
     .oayujs-Colaiks-0 ul li a:hover{
        background-color: transparent !important;
     }
     
     .oayujs-Colaiks-0 ul li a.LL-btn-Bg:hover{
    background-color: #2877df !important;

     }

     .oayujs-Colaiks-0 ul li a.Gen-Btn-A{
        justify-content: center !important;
        align-items: center !important;
        text-align: center !important;
     }

     .oayujs-Colaiks-0 ul li.mobilw-Li-Hide-PC{
        display: flex !important;
     }
     .oayujs-Colaiks-0 ul li.mobilw-Li-Hide-PC a{
        align-items: center !important;
        justify-content: space-between !important;
     }


}


@media screen and (max-width:400px){
      .oayujs-Colaiks{
        width: 100% !important;
      }
}












/* LLL-Header-Secc */

.LLL-Header-Secc{
    position: relative;
    width: 100%;
     background: linear-gradient(
        135deg,
        #EEF5FF 0%,
        #ffffff 30%,
        #fff9e6 60%,
        #e6fff5 90%
      );    
      padding: 80px 0px;
}


.LLL-Header-Hero{
    position: relative;
    width: 100%;
    display: grid;
    grid-template-columns: 1fr 0.7fr;
    gap: 30px;
}

.LLL-Header-Hero-Img{
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.LLL-Header-Hero-Img img{
    max-width: 100%;
    position: absolute;
    left: -30%;
    margin-top: 50px;
}

@media screen and (max-width:1200px){
    .LLL-Header-Secc{
        padding: 50px 0px !important;
    }
.LLL-Header-Hero-Img img{
    position: relative !important;
    left: 0% !important;
    margin-top: 0px !important;
}
}

@media screen and (max-width:1000px){
.LLL-Header-Hero{
    display: flex !important;
    flex-direction: column !important;
    align-items: center !important;
    justify-content: center !important;
}
}

.LLL-Header-Hero-Dlt{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
}

/* .LLL-Header-Hero-Dlt h1 span{
    color: #3F8AEF;
} */

.LLL-Header-Hero-Dlt p{
    margin-top: 10px;
    font-size: 15px;
    color: #818292 !important;
}


.LLL-Header-Hero-Dlt h4{
    position: relative;
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 10px;
    margin-top: 20px;
}

.LLL-Header-Hero-Dlt h4 img{
    max-width: 100px;
}

.LLL-Header-Hero-Dlt h4 span{
    font-size: 14px;
    font-weight: 500;
}

.All-Partrts{
    max-width: 300px;
     margin-top: 20px;
}



/* OOik-Secso */

.OOik-Secso{
    position: relative;
    width: 100%;
    height: auto;
    padding:5px 40px;
     border:1px solid #dbe0e1;
     background-color: #fff;
    border-radius: 5px;
    display: flex;
    align-items: center;
    gap: 20px;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-top:20px;
}
@media screen and (max-width:1300px){
    .OOik-Secso{
         padding:5px 20px !important;
    }
}

.OOik-Secso-0 h3{
    font-size: 13px;
    font-weight: 400;
}


.OOik-Secso-0{
    position: relative;
    display: inline-flex;
    align-items: center;
     gap: 40px;
    flex-wrap: wrap;
}

.OOik-Secso-0 img{
    max-width: 400px;
}
@media screen and (max-width:1200px){
.OOik-Secso-0 img{
    max-width: 200px !important;
}
.OOik-Secso-0{
    gap: 20px !important;
}
.OOik-Secso{
    padding: 20px !important;
    margin-top: 20px !important;
}
}

@media screen and (max-width:1000px){
.OOik-Secso{
    padding: 0px !important;
    border:none !important;
}
.OOik-Secso-1{
    display: none !important;
}

.OOik-Secso-0{
    flex-direction: column !important;
    width: 100% !important;
    justify-content: center !important;
    text-align: center !important;
    gap: 10px !important;
}
.OOik-Secso-0 h3{
    line-height: 160% !important;
}
}
.OOik-Secso-1 a{
    position: relative;
    padding: 12px 15px;
    border-radius: 5px;
    font-size: 12px;
}





.courses-main{
    margin-top:30px !important;
}

.Gen-courses-main .courses-owl .item, .courses-main .courses-owl .item{
    padding:0px !important;
}











/* Crrart-Pappa */

.Crrart-Pappa{
    position: relative;
    width: 100%;
    height: auto;
    min-height: 100vh;
    margin-bottom:30px;
}


.Crrart-Pappa-header{
    position: relative;
    width: 100%;
    height: auto;
    padding-top: 50px;
    display: block;
}

.Crrart-Pappa-header p{
    position: relative;
    margin-top: 10px;
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 12px;
    color: #b5b4b4;
}

.Crrart-Pappa-header p a{
    color: #3F8AEF;
}

.Crrart-Pappa-header p a:hover{
    text-decoration: underline;
}

.samppl-span{
    color: #2a2b3f;
}



/* Crrart-Pappa-Partss */


.Crrart-Pappa-Partss{
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 30px;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 50px;
}

@media screen and (max-width:1000px){
   .Crrart-Pappa-Partss{
    display: flex !important;
    flex-direction: column !important;
    gap: 30px !important;
   } 
}




.Crrart-Pappa-Partss-1{
    position: relative;
    width: 100%;
    height: auto;
}

.Crrart-Pappa-Partss-1-header{
    position: relative;
    width: 100%;
    height: auto;
    padding: 20px 0px;
}

.Crrart-Pappa-Partss-1-header h3{
    font-size: 14px;
    font-weight: 600;
}




.Crrart-Pappa-CArd{
    position: relative;
    width: 100%;
    height: auto;
    padding: 30px 0px;
    border-top: 1px solid #dbe0e1;
    display: grid;
    grid-template-columns: auto 1fr;
    gap: 20px;
}
@media screen and (max-width:600px){
    .Crrart-Pappa-CArd{
        display: flex !important;
        flex-direction: column !important;
    }

    .Crrart-Pappa-CArd-1 img{
        width: 100% !important;
        height: auto !important;
        max-height: 100% !important;
    }
}
.Crrart-Pappa-CArd-1{
    position: relative;
}

.Crrart-Pappa-CArd-1 img{
    position: relative;
    width: 100px;
    max-height: 100px;
    object-fit: cover;
    object-position: center;
}

.Crrart-Pappa-CArd-2{
    position: relative;
    width: 100%;
    height: auto;
}

.Crrart-Pappa-CArd-2-Top{
    position: relative;
    width: 100%;
    height: auto;
    display: grid;
    grid-template-columns: 1fr auto;
    gap: 20px;
}
@media screen and (max-width:600px){
  .Crrart-Pappa-CArd-2-Top{
    display: flex !important;
    flex-direction: column !important;
   } 
   .Crrart-Pappa-CArd-2-Top-2{
    text-align: left !important;
   }
}
.Crrart-Pappa-CArd-2-Top-1{
    position: relative;
    width: 100%;
    height: auto;
}

.Crrart-Pappa-CArd-2-Top-1 h2{
    font-size:17px;
    font-weight: 600;
    width: 100%;
    height: auto;
    overflow: hidden;
    line-clamp: 21;
    -webkit-line-clamp:1;
    -webkit-box-orient: vertical;
    display: -webkit-box;
}

.Crrart-Pappa-CArd-2-Top-1 p{
    font-size:13px;
    color: #666;
    width: 100%;
    height: auto;
    overflow: hidden;
    line-clamp: 1;
    -webkit-line-clamp:1;
    -webkit-box-orient: vertical;
    display: -webkit-box;
    margin-top: 8px;
}

.Crrart-Pappa-CArd-2-Top-2{
    position: relative;
   text-align: right;
}

.Crrart-Pappa-CArd-2-Top-2 h3{
    font-size: 20px;
    font-weight: 600;
    color: #3F8AEF;
}

.Crrart-Pappa-CArd-2-Top-2 span{
    color: #666;
    font-size: 11px;
    text-decoration: line-through;
}


.Crrart-Pappa-CArd-2-Foot{
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 10px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 8px;
}



.Crrart-Pappa-CArd-2-Foot h4{
    display: inline-flex;
    align-items: center;
    gap:5px;
    grid-gap: 5px;
    font-size: 12px;
    font-weight: 700;
    margin-bottom: 10px;
}
.Crrart-Pappa-CArd-2-Foot h4 span img{
    width: 12px;
}
.Crrart-Pappa-CArd-2-Foot h4 span{
    display: inline-flex;
    align-items: center;
    gap:2px;
    grid-gap: 2px;
}
.Crrart-Pappa-CArd-2-Foot h4 b{
    font-weight: 400;
    font-size: 10px;
    color: #666;
}
@media screen and (max-width:400px){
    .Crrart-Pappa-CArd-2-Foot h4{
        font-size: 11px !important;
    }
    .Crrart-Pappa-CArd-2-Foot h4 b{
        font-size: 10px !important;
    }
    .Crrart-Pappa-CArd-2-Foot h4 img{
        width: 10px !important;
    }
}


.Crrart-Pappa-CArd-2-Foot-Btns{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    flex-wrap: wrap;
}


.Crrart-Pappa-CArd-2-Foot-Btns button,
.Crrart-Pappa-CArd-2-Foot-Btns a{
    position: relative;
    display: inline-flex;
    align-items: center;
    padding: 8px 10px;
    background-color: #EEF5FF;
    color: #3F8AEF;
    font-size: 10px;
    border-radius: 5px;
    line-height: 100% !important;
    gap: 5px;
    transition: all 0.3s ease-in-out;
}

.Crrart-Pappa-CArd-2-Foot-Btns button:hover,
.Crrart-Pappa-CArd-2-Foot-Btns a:hover{
    background-color: #e0e9f5;
}

.remove-bbbna{
    background-color: #fef5f8 !important;
    color: #F82B60 !important;
}

.remove-bbbna:hover{
    background-color: #f4e7eb !important;
    color: #F82B60 !important;
}





/* Crrart-Pappa-Partss-2 */



.Crrart-Pappa-Partss-2{
    position: sticky;
    width: 350px;
    height: auto;
    min-height: 200px;
    top: 100px;
    z-index: 1000;
}

@media screen and (max-width:1000px){
  .Crrart-Pappa-Partss-2{
    position: relative !important;
    width: 100% !important;
    height: auto !important;
    top: 0px !important;
     border-top: 1px solid #dbe0e1;
  }
}



.Crrart-Pappa-Partss-2-Main{
    position: inherit;
    height: inherit;
    min-height: inherit;
    width: inherit;
    top: inherit;
    z-index: inherit;
    background-color: #fff;
}


.Crrart-Pappa-Partss-2-Main .Crrart-Pappa-Partss-1-header h3{
    color: #666;
}

.Crrart-Check-Boosia{
    position: relative;
    padding: 20px 0px;
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    gap: 10px;
}



.Crrart-Check-Boosia h3{
    font-size: 30px;
    font-weight: 700;
    color: #e27221;
}
@media screen and (max-width:500px){
.Crrart-Check-Boosia h3{
    font-size: 25px !important;
}
}

.Crrart-Check-Boosia span{
    color: #666;
    text-decoration: line-through;
    font-size: 12px;
}

.Crrart-Check-Boosia button{
    position: relative;
    padding: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
    font-size: 12px;
    border-radius: 5px;
}

@media screen and (max-width:300px){
.Crrart-Check-Boosia button i{
    display: none !important;
}
}

.Crrart-Check-Boosia p{
    font-size: 12px;
    color: #666;
    display: flex;
    align-items: flex-start;
    gap: 5px;
}

.Crrart-Check-Boosia p i{
    margin-top: 3px;
}


</style>


































































<style>

.notifier_alert span{
    display:inline-flex !important;
    align-items:center !important;
    justify-content:center !important;
    text-align:center !important;
    width:25px !important;
    height:25px !important;
    border-radius:50% !important;
}
  .sub-CC-Card h3{
      margin-top:7px !important;
  }


  .sub-CC-Card h3 b.HH3-Ammint b{
    font-size: 14px !important;
    font-weight: 500 !important;
    color: #3F8AEF !important;
     padding:0px !important;
    background-color: transparent !important;
}

 .sub-CC-Card h5{
     font-weight:400 !important;
     color:#54616C !important;
     margin-top:10px !important;
 }
   
      .sub-CC-Card h3 b.HH3-Ammint span{
       color:#54616C !important;
       font-size:12px !important;
       font-weight:400 !important;
       text-decoration: line-through !important;
        padding:0px !important;
    background-color: transparent !important;
   }
   
   
   .Top-Gland-card-1 img{
       width:50px !important;
       height:50px !important;
       border-radius:50% !important;
       object-fit:cover !important;
       object-position:center !important;
   }
   
   
   
   /*.courses-header h3{*/
   /*    margin-left:15px !important;*/
   /*}*/
   
   

   
   .sub-yyuy-header-2{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 10px;
    grid-gap: 10px;
    margin:15px 0px;
}


.sub-yyuy-header-2 a{
    position: relative;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    grid-gap: 8px;
    padding: 10px 20px;
   background-color: transparent;
    color: #3F8AEF !important;
    border-radius: 5px;
    font-size: 13px;
    border:2px solid #3F8AEF;
    transition: all 0.3s ease-in-out;
}



.sub-yyuy-header-2 a:hover{
    color:#fff !important;
    background:#3F8AEF;
}










/* rate-dropdown */

.rate-dropdown{
    position: fixed;
    z-index: 3000;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.9);
    display: none;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.show-rate-dropdown.rate-dropdown{
    display: flex !important;
}


.rate-dropdown-box{
    position: relative;
    width: 400px;
    height: auto;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    opacity: 0;
    transform: translateY(100px);
    animation: fadeBoxIn 0.3s ease-in forwards;
}

@keyframes fadeBoxIn{
    from{
        opacity: 0;
        transform: translateY(100px); 
    }
    to{
        opacity: 1;
        transform: translateY(0px); 
    }
}

@-webkit-keyframes fadeBoxIn{
    from{
        opacity: 0;
        transform: translateY(100px); 
    }
    to{
        opacity: 1;
        transform: translateY(0px); 
    }
}

@-moz-keyframes fadeBoxIn{
    from{
        opacity: 0;
        transform: translateY(100px); 
    }
    to{
        opacity: 1;
        transform: translateY(0px); 
    }
}

@media screen and (max-width:500px){
    .rate-dropdown-box{
        width: 90% !important;
    }
}
.rate-header{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 10px;
    grid-gap: 10px;
}

.rate-header h2{
    font-size: 20px;
    font-weight: 600;
}

.rate-header button{
    position: relative;
    width: 30px;
    height: 30px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-radius: 5px;
    background-color: red;
    font-size: 12px;
    border:none;
    color:#fff;
    cursor: pointer;
}

.rate-form{
    position: relative;
    width: 100%;
    height: auto;
    margin-top: 20px;
}

.rate-input{
    position: relative;
    width: 100%;
    height: auto;
    display: flex;
    flex-direction: column;
    margin-top: 20px;
}
.rate-input label{
    font-size: 11px;
    font-weight: 700;
    margin-bottom: 10px;
    text-transform: uppercase;
}

.rate-input textarea,
.rate-input select,
.rate-input input{
    position: relative;
    width: 100%;
    height: 50px;
    border:1px solid #b2b0b0;
    padding: 0px 10px;
    border-radius: 5px;
}
.rate-input textarea:focus,
.rate-input select:focus,
.rate-input input:focus{
    border-color: #3F8AEF;
}
.rate-input textarea{
    height: 150px;
    padding: 10px 15px;
}

.rate-input input[type="submit"]{
    background-color: #3F8AEF;
    color: #fff;
    border-color: #3F8AEF;
    transition: all 0.3s ease-in-out;
}

.rate-input input[type="submit"]:hover{
    background-color: #fff;
    color: #3F8AEF;
}


.waty-a{
    display: inline-flex;
    align-items: center;
    gap: 7px;
    grid-gap: 7px;
}

.waty-a i{
    margin-top: 1px;
}

   
</style>






















<style>
    
    .Notti-Card{
        border:1px solid #e6e7e9 !important;
        padding:20px !important;
        border-radius:10px !important;
    }
        .Notti-Card:last-child{
        border:1px solid #e6e7e9 !important;
    }
    
    .Top-Notti-Card h3{
        position:relative;
        display:inline-flex;
        align-items:center;
        gap:10px;
    }
    
.Top-Notti-Card h3 span {
    position: relative;
    width: 35px;
    height: 35px;
    background-color: #EFF2F6;
    border-radius: 5px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    text-transform: uppercase;
    font-weight: 700;
    color: #000;
    font-size:17px !important;
    text-transform:uppercase !important;
}
    
</style>




<style>
    .diary-dddop{
    position: relative;
    width: 25px;
    height: 25px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    background-color: transparent;
    cursor:pointer;
}

#lkklla-Hide{
    display:none !important;
}

@media screen and (max-width:500px){

    #lkklla-Hide{
    display:flex !important;
}
.Notice-Icons-Ahrf{
    display:none !important;
}
}



.message-hgHAI{
	position: relative;
	width: auto;
	height: 30px;
	padding:0px 15px;
	margin-top:10px;
	border-radius: 5px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	text-align: center;
	background-color: #3F8AEF;
    color: #fff;
    box-shadow: 0 0 20px rgb(63 138 239 / 8%);
    -webkit-box-shadow: 0 0 20px rgb(63 138 239 / 8%);
    -moz-box-shadow: 0 0 20px rgb(63 138 239 / 8%);
    user-select: none;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
    gap:8px;
    font-size:14px;
}

.message-hgHAI:hover{
	background:#5199f8 !important;
}



.message-hgHAI span{
	position: absolute;
	top: 3px;
	right: 5px;
	width: auto;
	height: 20px;
	display: inline-flex;
	align-items: center;
	justify-content: center;
	text-align: center;
	padding: 0px 8px;
	font-size:10px !important;
}




.m-container{
    position: relative;
    width: 100%;
    display:flex;
    align-items:center;
    justify-content:center;
    z-index:1;
}


  /*chat-sec*/
.chat-sec{
    position: relative;
    width: 600px;
    height: 600px;
    border-radius: inherit;
    background-color: #ffffff;
      -webkit-box-shadow: rgb(199 196 218 / 40%) 20px 20px 100px;
    box-shadow: rgb(199 196 218 / 40%) 20px 20px 100px;
    -webkit-animation:fadeInUp 0.6s ease-in-out;
    -moz-animation:fadeInUp 0.6s ease-in-out;
    animation:fadeInUp 0.6s ease-in-out;
}
@media screen and (max-width:700px){
    .chat-sec{
        width: 100% !important;
        height:85vh !important;
        top: 0% !important;
        right: 0% !important;
    }
}
.chat-sec-Head{
    position:absolute;
    top: 0;
    width: 100%;
    height:auto;
    left: 0;
    padding: 10px 20px;
    background-color: #ffffff;
    border-top-right-radius: inherit;
    border-top-left-radius: inherit;
    border-bottom: 1px solid #dadde0;
    display: flex;
    align-items: center;
    z-index: 1000;
}
.chat-sec-header{
    position:relative;
    top: 0;
    width: 100%;
    height: 50px;
    left: 0;
    display: flex;
    align-items: center;
    z-index: 1000;
    display: grid;
    grid-template-columns:30px 1fr;
    grid-gap:10px;
}
.chat-sec-header img{
    width:30px;
    height: 30px;
    object-fit: cover;
    border-radius: 50%;
}
.chat-sec-header-txt{
    position: relative;
    width: 100%;
    height: auto;
    display: block;
    overflow: hidden;
}
.chat-sec-header-txt span{
    padding:2px 8px;
    border-radius: 3px;
    background-color:#F6B023;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    margin-top: 5px;
    font-size: 10px;
    letter-spacing: 0.3px;
    font-weight: 600;
    color: #000;
    text-transform: uppercase;
}
.chat-sec-header p{
    margin: 0;
    padding: 0;
    display: block;
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    width: 100%;
    font-size:15px;
    color: #464a53;
    font-weight: 600;
}
.close-m-container{
    position:relative;
    top: 0;
    right: 0;
    width: 30px;
    height: 30px;
    outline: none;
    border: none;
    font-size: 15px;
    border-radius: 3px;
    z-index: 10;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #ffffff;
    background-color: #FB2460;
}
/*message-sec*/
.message-sec{
    position: relative;
    width: 100%;
    height: 100%;
    padding:70px 20px;
    overflow-y: auto;
    padding-bottom: 100px;
}

/*artisan-message-div*/
.artisan-message-div{
    position: relative;
    width: 100%;
    display: grid;
    grid-template-columns:30px 1fr;
    grid-gap:10px;
    margin-top: 20px;
    margin-bottom: 20px;
}
.user-img{
    position: relative;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    width: 30px;
    height: 30px;
    background-color: #ffffff;
    -webkit-box-shadow: -10px 10px 50px rgb(0 0 0 / 10%);
    box-shadow: -10px 10px 50px rgb(0 0 0 / 10%);
    border-radius: 50%;
    border: none;
    outline: none !important;
}
.user-img img{
    width: inherit;
    height: inherit;
    object-fit: cover;
}
.chart-thumbnail{
    position: relative;
    display: block;
    width:100%;
    background-color: #f5f5f7;
    padding: 10px 20px;
    border-radius: 15px;
    border-bottom-left-radius: 0px;
}
.chart-thumbnail p{
    margin: 0;
    padding: 0;
    font-size: 14px;
     color: #464a53;
}

.chart-thumbnail span{
    position: relative;
    display: flex;
    padding: 10px 0px;
    align-items: center;
    justify-content: flex-end;
    font-size:13px;
    opacity:0.9;
}

.user-message-div{
      position: relative;
    width: 100%;
     display: grid;
    grid-template-columns:1fr 30px;
    grid-gap:5px;;
    margin-top: 20px;
    margin-bottom: 20px;
    justify-content: flex-end;
}

 .user-message-div .chart-thumbnail{
   background-color: #7E4FFF;
    color: #ffffff;
    border-bottom-right-radius: 0px;
    border-bottom-left-radius: 20px;
}

.m-container-2  .user-message-div .chart-thumbnail{
    background-color: #3F8AEF;
}

 .user-message-div .chart-thumbnail p{
    color: #ffffff;
 }

/*chat-sec-footer*/
.chat-sec-footer{
    position: absolute;
    bottom: 0;
    width: 100%;
    height: 70px;
    background-color: #ffffff;
    z-index: 1000;
    border-bottom-right-radius: inherit;
    border-bottom-left-radius: inherit;
    -webkit-box-shadow: -10px 10px 50px rgb(0 0 0 / 10%);
    box-shadow: -10px 10px 50px rgb(0 0 0 / 10%);
    display: grid;
    grid-template-columns:1fr auto;
    grid-gap:5px;
    padding: 0px 20px;
}
.chat-sec-foote-input{
    position: relative;
    width: 100%;
    height: 100%;
    display:inline-flex;
    align-items: center;
    border-right: 1px solid #F3F1FA;
}
.chat-sec-footer textarea{
    width: 100%;
    height: auto;
    background-color: transparent;
    border: none;
    outline: none;
    margin-top: 10px;
    resize: none;
    color: #464a53;
}


.chat-sec-footer-btns{
    position: relative;
    width: 100%;
    height: 100%;
    padding: 10px;
    user-select: none;
    display: inline-flex;
    align-items: center;
    grid-gap:5px;
}
.chat-sec-footer-btns li,
.chat-sec-footer-btns li label{
    width: 40px;
    height: 40px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    border-radius: 50%;
    color: #464a53;
    cursor: pointer;
    transition: all 0.3s ease-in-out;
}
.send-btn,
.chat-sec-footer-btns li:hover{
    background-color: #F5F5F7;
}
.send-btn:hover{
    background-color: #3F8AEF !important;
    color: #ffffff;
}
#upload-chat-img{
    display: none;
}



</style>



















 <style>
 
 .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover{
      position: relative !important;
    width: 30px !important;
    height: 30px !important;
    border: 1px solid #3F8AEF !important;
    border-radius: 5px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    text-align: center !important;
    font-size: 10px !important;
    background-color: transparent !important;
    cursor: pointer !important;
    transition: all 0.3s ease-in-out !important;
    color:#3F8AEF !important;
 }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.8);
      display: none;
      align-items: center;
      justify-content: center;
      z-index: 9999;
    }

    .ooomodal {
      background: white;
      padding: 20px;
      max-width: 80%;
      border-radius: 8px;
      position: relative;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 18px;
      cursor: pointer;
      color: #333;
      display:inline-flex;
    }

    .close-btn:hover {
      color: red;
    }

    @media (max-width: 480px) {
      .ooomodal {
        padding: 1rem;
        border-radius: 8px;
        max-width:90% !important;
      }

      .close-btn {
        font-size: 18px;
        top: 10px;
        right: 10px;
      }
    }



  </style>
  
  
  
  <style>
          .aoksika-Bgba{
        position:relative;
        max-width:600px;
        display:inline-flex;
        
    }
    
    @media screen and (max-width:700px){
        .aoksika-Bgba{
            max-width:90% !important;
        }  
    }
    
    
    
    
    
    
    .Reg_Input input[type="file"]{
        padding-top:13px !important;
    }
    
  </style>
  
  
