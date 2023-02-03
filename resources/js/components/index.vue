<script setup>
import { useRouter } from 'vue-router';
import { Navigation, Pagination, Scrollbar, A11y } from 'swiper';
import { Swiper, SwiperSlide,useSwiper} from 'swiper/vue';

// Import Swiper styles
import 'swiper/css';
  import 'swiper/css/navigation';
  import 'swiper/css/pagination';
  import 'swiper/css/scrollbar';
import { onMounted, ref } from 'vue';
const router= useRouter();
const swipe = useSwiper();
let cars = ref([]);  
let info_id=ref({
  car:'',
  dataCar:{}
}); 
const all_cars = async () =>{
    let response = await axios.get("/api/get_all_cars").
    then(response=>{
     cars.value = response.data.carros; 

    });
}
const switchPage= ()=>{
  swipe.slideNext();
}; 
const setCar_id= (id)=>{ 
  info_id.value.car=id.id;
  info_id.value.dataCar=id;
}
onMounted(async () => { 
    all_cars();   
    console.log(cars);
}); 

</script>

<template> 
<div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
     
      <div class="container-fluid" style="z-index: 100;
    position: fixed;">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">

          <a class="navbar-brand" href="/index">
            <span>
              RENT A CAR
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex  flex-column flex-lg-row align-items-center w-100 justify-content-between">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="#inicio_section">Inicio <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#ftre_section"> Servicios </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#Autos_section">Autos</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#footer_section">Acerca de nosotros</a>
                </li>
                <li class="nav-item">
                 <a ></a>
                </li>
              </ul>
              <form class="form-inline ">
                <input type="search" placeholder="Search">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
              <div class="login_btn-contanier ml-0 ml-lg-5">
                <a href="/login">
                  <img src="images/user.png" alt="">
                  <span>
                    Login
                  </span>
                </a>
              </div>
            </div>
          </div>

        </nav>
      </div>
    </header>
    <!-- end header section -->
    <!-- slider section -->
    <section  id="inicio_section" class=" slider_section position-relative">
      <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
          <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="img-box">
                    <img src="/index_styles/images/carro.jpg" width="423" height="485" alt="">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="detail-box">
                    <h1>
                      Bienvenido a nuestra <br>
                      <span>
                        Renta de Autos Online
                      </span>

                    </h1>
                    <p>
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour, or randomised words which don't look even slightly
                      believable.
                    </p>
                    <div>
                      <a href="">
                        Buy Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="img-box">
                    {/* <img src="/index_styles/images/carro.jpg" alt=""> */}
                  </div> 
                </div>
                <div class="col-md-8">
                  <div class="detail-box">
                    <h1>
                      Welcome To Our <br>
                      <span>
                        Online Medicine
                      </span>

                    </h1>
                    <p>
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour, or randomised words which don't look even slightly
                      believable.
                    </p>
                    <div>
                      <a href="">
                        Buy Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="container">
              <div class="row">
                <div class="col-md-4">
                  <div class="img-box">
                    <img src="/index_styles/images/medicine.png" alt="">
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="detail-box">
                    <h1>
                      Welcome To Our <br>
                      <span>
                        Online Medicine
                      </span>

                    </h1>
                    <p>
                      There are many variations of passages of Lorem Ipsum available, but the majority have suffered
                      alteration in some form, by injected humour, or randomised words which don't look even slightly
                      believable.
                    </p>
                    <div>
                      <a href="">
                        Buy Now
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
          <span class="sr-only">Next</span>
        </a>
      </div>


    </section>
    <!-- end slider section -->
  </div>
 
  
  <section id="ftre_section" class="feature_section  layout_padding">
    <div class="container">
      <div class="feature_container">
        <div class="box">
          <div class="img-box">
            <svg fill="#000000" width="800px" height="800px" viewBox="0 -43.92 122.88 122.88" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  style="enable-background:new 0 0 122.88 35.03" xml:space="preserve">


<g>

<path class="st0" d="M99.42,13.57c5.93,0,10.73,4.8,10.73,10.73c0,5.93-4.8,10.73-10.73,10.73s-10.73-4.8-10.73-10.73 C88.69,18.37,93.49,13.57,99.42,13.57L99.42,13.57z M79.05,5c-0.59,1.27-1.06,2.69-1.42,4.23c-0.82,2.57,0.39,3.11,3.19,2.06 c2.06-1.23,4.12-2.47,6.18-3.7c1.05-0.74,1.55-1.47,1.38-2.19c-0.34-1.42-3.08-2.16-5.33-2.6C80.19,2.23,80.39,2.11,79.05,5 L79.05,5z M23.86,19.31c2.75,0,4.99,2.23,4.99,4.99c0,2.75-2.23,4.99-4.99,4.99c-2.75,0-4.99-2.23-4.99-4.99 C18.87,21.54,21.1,19.31,23.86,19.31L23.86,19.31z M99.42,19.31c2.75,0,4.99,2.23,4.99,4.99c0,2.75-2.23,4.99-4.99,4.99 c-2.75,0-4.99-2.23-4.99-4.99C94.43,21.54,96.66,19.31,99.42,19.31L99.42,19.31z M46.14,12.5c2.77-2.97,5.97-4.9,9.67-6.76 c8.1-4.08,13.06-3.58,21.66-3.58l-2.89,7.5c-1.21,1.6-2.58,2.73-4.66,2.84H46.14L46.14,12.5z M23.86,13.57 c5.93,0,10.73,4.8,10.73,10.73c0,5.93-4.8,10.73-10.73,10.73s-10.73-4.8-10.73-10.73C13.13,18.37,17.93,13.57,23.86,13.57 L23.86,13.57z M40.82,10.3c3.52-2.19,7.35-4.15,11.59-5.82c12.91-5.09,22.78-6,36.32-1.9c4.08,1.55,8.16,3.1,12.24,4.06 c4.03,0.96,21.48,1.88,21.91,4.81l-4.31,5.15c1.57,1.36,2.85,3.03,3.32,5.64c-0.13,1.61-0.57,2.96-1.33,4.04 c-1.29,1.85-5.07,3.76-7.11,2.67c-0.65-0.35-1.02-1.05-1.01-2.24c0.06-23.9-28.79-21.18-26.62,2.82H35.48 C44.8,5.49,5.04,5.4,12.1,28.7C9.62,31.38,3.77,27.34,0,18.75c1.03-1.02,2.16-1.99,3.42-2.89c-0.06-0.05,0.06,0.19-0.15-0.17 c-0.21-0.36,0.51-1.87,1.99-2.74C13.02,8.4,31.73,8.52,40.82,10.3L40.82,10.3z"/>

</g>

</svg>
          </div>
          <div class="detail-box">
            <h5>
              Autos Nuevos
            </h5>
            <p>
            Ofrecemos la renta de autos nuevos
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512"
              xmlns="http://www.w3.org/2000/svg">
              <path
                d="m471.728 84.718h-431.456c-22.206 0-40.272 18.066-40.272 40.272v243.623 18.395.005c0 22.205 18.064 40.27 40.27 40.27h431.46c22.205 0 40.27-18.065 40.27-40.27v-.005-18.395-243.623c0-22.206-18.066-40.272-40.272-40.272zm-431.456 20h431.455c11.179 0 20.272 9.094 20.272 20.272v233.623h-294.622c-5.522 0-10 4.477-10 10s4.478 10 10 10h294.623v8.395c0 11.178-9.094 20.272-20.272 20.272h-431.456c-11.178 0-20.272-9.094-20.272-20.273v-8.395h89.418c5.522 0 10-4.477 10-10s-4.478-10-10-10h-89.418v-233.622c0-11.178 9.094-20.272 20.272-20.272z" />
              <path
                d="m280.063 167.544h53.989c5.522 0 10-4.477 10-10s-4.478-10-10-10h-53.989c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
              <path
                d="m377.55 167.544h55.505c5.522 0 10-4.477 10-10s-4.478-10-10-10h-55.505c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
              <path
                d="m280.063 210.314h152.992c5.522 0 10-4.477 10-10s-4.478-10-10-10h-152.992c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
              <path
                d="m280.063 254.169h45.989c5.522 0 10-4.477 10-10s-4.478-10-10-10h-45.989c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
              <path
                d="m422.75 234.169h-38.993c-13.348 0-24.207 10.859-24.207 24.207v37.636c0 13.348 10.859 24.208 24.207 24.208h38.993c13.348 0 24.207-10.859 24.207-24.208v-37.636c0-13.348-10.859-24.207-24.207-24.207zm4.207 61.843c0 2.32-1.888 4.208-4.207 4.208h-38.993c-2.319 0-4.207-1.888-4.207-4.208v-37.636c0-2.32 1.888-4.207 4.207-4.207h38.993c2.319 0 4.207 1.887 4.207 4.207z" />
              <path
                d="m280.063 298.297h45.989c5.522 0 10-4.477 10-10s-4.478-10-10-10h-45.989c-5.522 0-10 4.477-10 10s4.477 10 10 10z" />
              <path
                d="m79.072 319.081h140.993c5.522 0 10-4.477 10-10v-39.955-114.582c0-5.523-4.478-10-10-10h-140.993c-5.522 0-10 4.477-10 10v114.583 39.955c0 5.522 4.478 9.999 10 9.999zm130.993-20h-120.993v-28.724c.03-.113.06-.227.091-.339 4.169-15.41 18.521-26.172 34.902-26.172h51.008c16.38 0 30.732 10.763 34.902 26.169.03.113.061.226.09.339zm-81.794-96.534c0-11.744 9.554-21.298 21.298-21.298s21.298 9.554 21.298 21.298-9.554 21.298-21.298 21.298-21.298-9.554-21.298-21.298zm81.794 33.371c-7.335-5.755-16.118-9.714-25.618-11.298 4.058-6.39 6.42-13.958 6.42-22.073 0-17.041-10.376-31.702-25.14-38.003h44.339v71.374zm-76.653-71.374c-14.765 6.301-25.14 20.963-25.14 38.003 0 8.114 2.362 15.683 6.42 22.073-9.501 1.583-18.285 5.543-25.619 11.298v-71.374z" />
              <path
                d="m159.66 360.3c-7.549-5.03-17.605 2.261-15.18 10.977 1.142 4.104 4.876 7.118 9.141 7.321 4.271.204 8.264-2.408 9.808-6.389 1.66-4.282.096-9.38-3.769-11.909z" />
            </svg>
          </div>
          <div class="detail-box">
            <h5>
              Licencia de COnducir 
            </h5>
            <p>
              Ofrecemos servicios a las personas con licencia de conducir sin vencer
            </p>
          </div>
        </div>
        <div class="box">
          <div class="img-box">
            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
              x="0px" y="0px" viewBox="0 0 315.377 315.377" style="enable-background:new 0 0 315.377 315.377;"
              xml:space="preserve">
              <g>
                <g>
                  <path
                    d="M107.712,181.769l-7.938,7.705c-1.121,1.089-1.753,2.584-1.753,4.146v3.288c0,3.191,2.588,5.779,5.78,5.779h47.4
                 c3.196,0,5.782-2.588,5.782-5.779v-4.256c0-3.191-2.586-5.78-5.782-5.78h-26.19l0.722-0.664
                 c17.117-16.491,29.232-29.471,29.232-46.372c0-13.513-8.782-27.148-28.409-27.148c-8.568,0-16.959,2.75-23.629,7.74
                 c-2.166,1.625-2.918,4.537-1.803,7.007l1.458,3.224c0.708,1.568,2.074,2.739,3.735,3.195c1.651,0.456,3.433,0.148,4.842-0.836
                 c4.289-2.995,8.704-4.515,13.127-4.515c8.608,0,12.971,4.28,12.971,12.662C137.142,152.524,127.72,162.721,107.712,181.769z" />
                </g>
                <g>
                  <path d="M194.107,114.096c-0.154-0.014-0.31-0.02-0.464-0.02h-1.765c-1.89,0-3.658,0.923-4.738,2.469l-35.4,50.66
                 c-0.678,0.971-1.041,2.127-1.041,3.311v4.061c0,3.192,2.586,5.78,5.778,5.78h32.322v16.551c0,3.191,2.586,5.779,5.778,5.779h5.519
                 c3.19,0,5.781-2.588,5.781-5.779v-16.551h5.698c3.192,0,5.781-2.588,5.781-5.78v-3.753c0-3.19-2.589-5.779-5.781-5.779h-5.698
                 v-45.189c0-3.19-2.591-5.779-5.781-5.779h-5.519C194.419,114.077,194.261,114.083,194.107,114.096z M188.799,165.045h-17.453
                 c4.434-6.438,12.015-17.487,17.453-25.653V165.045z" />
                </g>
                <g>
                  <path
                    d="M157.906,290.377c-68.023,0-123.365-55.342-123.365-123.365c0-64.412,49.625-117.443,112.647-122.895v19.665
                 c0,1.397,0.771,2.681,2.003,3.337c0.558,0.298,1.169,0.444,1.778,0.444c0.737,0,1.474-0.216,2.108-0.643l44.652-30
                 c1.046-0.702,1.673-1.879,1.673-3.139c0-1.259-0.627-2.437-1.673-3.139l-44.652-30c-1.159-0.779-2.654-0.857-3.887-0.198
                 c-1.232,0.657-2.003,1.941-2.003,3.337v15.254C70.364,24.547,9.54,88.806,9.54,167.011c0,81.809,66.558,148.365,148.365,148.365
                 c37.876,0,73.934-14.271,101.532-40.183l-17.111-18.226C219.38,278.512,189.4,290.377,157.906,290.377z" />
                </g>
                <g>
                  <path d="M284.552,89.689c-5.111-8.359-11.088-16.252-17.759-23.456l-18.344,16.985c5.552,5.995,10.522,12.562,14.776,19.515
                 L284.552,89.689z" />
                </g>
                <g>
                  <path d="M280.146,150.258l24.773-3.363c-1.322-9.74-3.625-19.373-6.846-28.632l-23.612,8.211
                 C277.135,134.163,279.047,142.165,280.146,150.258z" />
                </g>
                <g>
                  <path d="M242.999,45.459c-8.045-5.643-16.678-10.496-25.66-14.427l-10.022,22.903c7.464,3.267,14.64,7.301,21.327,11.991
                 L242.999,45.459z" />
                </g>
                <g>
                  <path d="M253.208,245.353l19.303,15.887c6.244-7.587,11.75-15.817,16.363-24.462l-22.055-11.771
                 C262.983,232.195,258.404,239.041,253.208,245.353z" />
                </g>
                <g>
                  <path d="M280.908,176.552c-0.622,8.157-2.061,16.264-4.273,24.093l24.057,6.802c2.666-9.426,4.396-19.18,5.146-28.99
                 L280.908,176.552z" />
                </g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
              <g>
              </g>
            </svg>

          </div>
          <div class="detail-box">
            <h5>
             Atencion a las 24/7
            </h5>
            <p>
              Puedes alquilar tu auto a cualquier hora, en cualquier lugar 
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end feature section -->

  <!-- discount section -->
  
  <section class="discount_section">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-3 col-md-5 offset-md-2">
          <div class="detail-box">
            <h2>
              You get <br>
              any Car <br>
              on
              <span>
                10% discount
              </span>

            </h2>
            <p>
              It is a long established fact that a reader will be distracted by
            </p>
            <div>
              <a href="#">
                Rent Now
              </a>
            </div>
          </div>
        </div>
        <div class="col-lg-7 col-md-5">
          <div class="img-box">
            <img src="/index_styles/images/carro.jpg" alt="">
          </div>
        </div>
      </div> 
    </div>
  </section>


  <!-- end discount section -->

  <!-- health section -->

  <section id="Autos_section" class="health_section layout_padding">
   <div>
   <swiper
   :modules="[Navigation, Pagination, Scrollbar, A11y]"
    :slides-per-view="5"
    :space-between="50"
    :loop="true"
    navigation
    :scrollbar="{ draggable: true }"
    :pagination="{clickable: true, dynamicBullets: true}"
    :autoplay="{
      delay: 7000,
      disableOnInteraction: false,
      pauseOnMouseEnter: true
    }"
  >
    <swiper-slide v-for="car in cars">
      <div role="button" @click="setCar_id(car)" data-bs-toggle="modal" data-bs-target="#exampleModal" >
      <p>{{car.modelo}}</p>
      <div class="img-box">
      <img :src='"/photo/"+(car.foto1 ? car.foto1 : "image.png")'  height="250" width="250" alt="">
      </div>
      </div>
      
    </swiper-slide>  
   
  </swiper>
 
  <car-modal :id="info_id.car" :car_data="info_id.dataCar"></car-modal> 
  </div> 
    
    <div class="d-flex justify-content-center">
      <a href="">
        See more
      </a>
    </div>
  </section>
 
  <!-- info section -->
  <section  id="footer_section" class="info_section layout_padding2">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <div class="info_contact">
            <h4>
              Contact
            </h4>
            <div class="box">
              <div class="img-box">
                <img src="/index_styles/images/telephone-symbol-button.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  +01 123567894
                </h6>
              </div>
            </div>
            <div class="box">
              <div class="img-box">
                <img src="/index_styles/images/email.png" alt="">
              </div>
              <div class="detail-box">
                <h6>
                  demo@gmail
                </h6>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="info_menu">
            <h4>
              Menu
            </h4>
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.html">Inicio <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.html"> Servicios </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="medicine.html"> Autos</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="buy.html"> Acerca de Nosotros </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="info_news">
            <h4>
              Encuentra nuestro negocio!
            </h4>
            <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=300&amp;height=200&amp;hl=en&amp;q=san diego carabobo&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://pdflist.com/" alt="pdf" style="
            .mapouter{position:relative;text-align:right;width:250px;height:200px;}.gmap_canvas {overflow:hidden;background:none!important;width:250px;height:200px;}.gmap_iframe {width:250px!important;height:200px!important;}"></a></div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- end info section -->

  <!-- footer section -->
  <section class="container-fluid footer_section">
    <p>
      &copy; 2023 Todos los derechos reservados
      <a href="https://html.design/">Rent a Car</a>
    </p>
  </section> 
</template>