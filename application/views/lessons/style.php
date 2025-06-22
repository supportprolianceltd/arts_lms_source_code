<style>

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

.ssubj-os{
    background-color: #3F8AEF !important;
    color: #fff !important;
    border-color: #3F8AEF !important;
    transition: all 0.3s ease-in-out;
}

.ssubj-os:hover{
    background-color: #5C9FF2 !important;
    color: #fff  !important;
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



.bg-dark {
    background-color: #3F8AEF !important;
}

  .navbar.fixed-top  a.btn-outline-secondary{
       border-color:#fff !important;
       color:#fff !important;
   }
   
  .navbar.fixed-top  a.btn-outline-secondary:hover{
       background:rgba(255,255,255,0.2) !important;
   }
   
   
   .course-content-items .item.active{
       background-color: #3F8AEF !important;

   }
   
.ct-tabs-custom-one button.nav-link.active, .ct-tabs-custom-one button.nav-link:hover{
    color: #3F8AEF !important;
}
   .ct-tabs-custom-one button.nav-link.active span, .ct-tabs-custom-one button.nav-link:hover span {
    opacity: 1;
    z-index: 1;
    background-color: #3F8AEF !important;
}

.RatHH-Btn{
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



.RatHH-Btn:hover{
    color:#fff !important;
    background:#3F8AEF;
}




</style>



