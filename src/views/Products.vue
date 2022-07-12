<template>
  <div class="products">
    <p class="products-text">Esta es nuestra selección de productos recomendados relacionados con la fotografía</p>
    <div class="items-container">
      <ProductItem v-for="product in finalProductsList" :key="product.name"
        :urlImage="product.image"
        :name="product.name"
        :url="product.url"
      />
    </div>
  </div>
</template>

<script>
import ProductItem from '../components/ProductItem.vue';

export default {
  data() {
    return {
      idProducts: this.$route.params.id,
      productsList: [
        {
          products: [
            {
              name: 'Canon EOS 2000D',
              image: 'https://m.media-amazon.com/images/I/61GqujOjXuL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Canon-Camera-2000d-55-III-2728-l50-c002/dp/B07BMV268V/ref=sr_1_2?adgrpid=56496329259&gclid=CjwKCAjw0a-SBhBkEiwApljU0n6dTI-B0Tba8et1yiHiai7LyMibDlmoQONEXukxMEeywG9rUyNy2RoCTfoQAvD_BwE&hvadid=275299138443&hvdev=c&hvlocphy=1005527&hvnetw=g&hvqmt=e&hvrand=15356051861543746136&hvtargid=kwd-342981820748&hydadcr=11893_1831461&keywords=canon+eos+2000d&qid=1649180188&sr=8-2'
            },
            {
              name: 'Canon EOS 4000D',
              image: 'https://m.media-amazon.com/images/I/41Np9b4LVBL._AC_.jpg',
              url: 'https://www.amazon.es/Canon-EOS-4000D-DSLR-C%C3%A1mara/dp/B07B199LGK/ref=sr_1_5?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-5'
            },
            {
              name: 'Nikon D3500 con Objetivo Nikkor',
              image: 'https://m.media-amazon.com/images/I/81SUiGUEwkL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Nikon-d3500-%C2%B0C%C3%A1mara-Objetivo-24-2-MPX-Neopreno/dp/B07HKPYQ3V/ref=sr_1_7?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-7'
            },
            {
              name: 'Panasonic Lumix DC-FZ82',
              image: 'https://m.media-amazon.com/images/I/81qszNigceL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Panasonic-Lumix-DC-FZ82EG-K-compacta-Tecnolog%C3%ADa/dp/B01NARXQ2E/ref=sr_1_8?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-8'
            },
            {
              name: 'Kodak Pixpro AZ401',
              image: 'https://m.media-amazon.com/images/I/617G1b-WbiL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Kodak-AZ401BK-Pixpro-AZ401-Negra/dp/B074WK5GW9/ref=sr_1_11?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-11'
            },
            {
              name: 'Nikon D5100',
              image: 'https://m.media-amazon.com/images/I/71DdyypyYBL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Nikon-C%C3%A1mara-digital-pulgadas-renovado/dp/B01MAY5JBL/ref=sr_1_15?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-15'
            },
            {
              name: 'Nikon D5300',
              image: 'https://m.media-amazon.com/images/I/81rNU5521bL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Nikon-C%C3%A1mara-digital-pulgadas-renovado/dp/B01MCV43GV/ref=sr_1_19?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-19'
            },
            {
              name: 'CANON EOS 77D',
              image: 'https://m.media-amazon.com/images/I/91DboCv-glL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Canon-EOS-77D-Bluetooth-Objetivo/dp/B06W2L6QHG/ref=sr_1_22?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-22'
            },
            {
              name: 'Canon EOS 1300D',
              image: 'https://m.media-amazon.com/images/I/51mkMMjYoIL._AC_.jpg',
              url: 'https://www.amazon.es/Canon-EOS-1300D-Pantalla-Objetivo/dp/B01J9LR3NM/ref=sr_1_25?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-25'
            },
            {
              name: 'Nikkon D7500',
              image: 'https://m.media-amazon.com/images/I/81bVHWevmyL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Nikkon-D7500-pantalla-SnapBridge-Bluetooth/dp/B06ZYCS62R/ref=sr_1_42?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=72YC4SAZ44SS&keywords=camara+reflex&qid=1657646637&sprefix=camara+reflex%2Caps%2C89&sr=8-42'
            }
          ]
        },
        {
          products: [
            {
              name: 'Olympus M.Zuiko Digital ED 40 - 150 mm F4 - 5.6 II',
              image: 'https://m.media-amazon.com/images/I/61rFB-8dT3L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Olympus-M-Zuiko-Digital-Objetivo-distancia/dp/B0058G4066/ref=sr_1_5?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&smid=A1AT7YVPFBWXBL&sprefix=objetivos+reflex%2Caps%2C94&sr=8-5'
            },
            {
              name: 'Sigma 576955 - 24-70 F2.8',
              image: 'https://m.media-amazon.com/images/I/71kltHdtE9L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Sigma-576955-Objetivo-R%C3%A9flex-24-70/dp/B072W9YR6T/ref=sr_1_6?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-6'
            },
            {
              name: 'Samyang Reflex f/6.3 300mm MFT MILC',
              image: 'https://m.media-amazon.com/images/I/813RvoEaZ+L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Samyang-Reflex-300mm-MILC-Negro/dp/B00DWYDALC/ref=sr_1_7?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-7'
            },
            {
              name: 'Nikon JAA829DA - AF-P DX 70-300 4.5-6.3G VR SD2',
              image: 'https://m.media-amazon.com/images/I/81aEHOg6zUL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Nikon-JAA829DA-Objetivo-C%C3%A1mara-4-5-6-3G/dp/B01KJ8UMKK/ref=sr_1_8?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-8'
            },
            {
              name: 'Sigma 150-600mm F5-6.3 DG OS HSM',
              image: 'https://m.media-amazon.com/images/I/81o6z3YrNZL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Sigma-150-600mm-F5-6-3-Objetivo-c%C3%A1mara/dp/B00THP1A1C/ref=sr_1_9?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-9'
            },
            {
              name: 'Vbestlife 420 mm / 800 mm F / 8.3-16',
              image: 'https://m.media-amazon.com/images/I/51HQ+xZhwGL._AC_SL1001_.jpg',
              url: 'https://www.amazon.es/Teleobjetivo-Rendimiento-Minolta-Olympus-Digitales/dp/B07Y8B8HN6/ref=sr_1_10?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-10'
            },
            {
              name: 'Sigma F1.4 DG HSM Art',
              image: 'https://m.media-amazon.com/images/I/71JX-NTMhsL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Sigma-F1-4-DG-HSM-Art/dp/B07JZRC98K/ref=sr_1_11?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-11'
            },
            {
              name: 'Yongnuo YN35MM Canon - (f/2.0 AF/MF)',
              image: 'https://m.media-amazon.com/images/I/71+zHIAhFSL._AC_SL1450_.jpg',
              url: 'https://www.amazon.es/Yongnuo-YN35MM-Canon-Objetivo-c%C3%A1mara/dp/B00W4Z82ZO/ref=sr_1_12?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-12'
            },
            {
              name: 'Yongnuo YN-35mm F/2',
              image: 'https://m.media-amazon.com/images/I/61jAqt+CZPL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Objetivo-Yongnuo-YN-35mm-c%C3%A1maras-Nikon/dp/B01L1JCKRY/ref=sr_1_13?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-13'
            },
            {
              name: 'Sigma 24-105mm F4 DG OS HSM',
              image: 'https://m.media-amazon.com/images/I/719W4eyth6L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Sigma-24-105mm-F4-HSM-estabilizador/dp/B00G6K4TXC/ref=sr_1_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-14'
            },
            {
              name: 'Yongnuo YN 50mm F / 1.8 AF/MF',
              image: 'https://m.media-amazon.com/images/I/61Km2w+OYxL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Yongnuo-Apertura-Enfoque-Autom%C3%A1tico-C%C3%A1mara/dp/B00VHFMIO8/ref=sr_1_15?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-15'
            },
            {
              name: 'Sigma 24 mm / F 1.4 DG HSM Art',
              image: 'https://m.media-amazon.com/images/I/91X5h9EFCHL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Sigma-24-1-4-HSM-Art/dp/B00THPL0AS/ref=sr_1_16?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=X0UAFGXAZ6EL&keywords=objetivos+reflex&qid=1657647527&sprefix=objetivos+reflex%2Caps%2C94&sr=8-16'
            }
          ]
        },
        {
          products: [
            {
              name: 'GoPro HERO10',
              image: 'https://m.media-amazon.com/images/I/51c15x1d4zL._AC_SL1024_.jpg',
              url: 'https://www.amazon.es/GoPro-HERO10-Black-transmisi%C3%B3n-estabilizaci%C3%B3n/dp/B09D15SFMQ/ref=sr_1_11?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=309DH6VM12IV2&keywords=gopro&qid=1657648246&sprefix=gopro%2Caps%2C90&sr=8-11'
            },
            {
              name: 'GoPro HERO9',
              image: 'https://m.media-amazon.com/images/I/61pPpftos+L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/GoPro-HERO9-Black-sumergible-transmisi%C3%B3n/dp/B08G2HBBB6/ref=sr_1_10?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=309DH6VM12IV2&keywords=gopro&qid=1657648246&sprefix=gopro%2Caps%2C90&sr=8-10'
            },
            {
              name: 'GoPro Max',
              image: 'https://m.media-amazon.com/images/I/71ZBo2ZrNUL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/GoPro-Estabilizaci%C3%B3n-Irrompible-Pantalla-Bluetooth/dp/B091J94FMC/ref=sr_1_12?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=309DH6VM12IV2&keywords=gopro&qid=1657648246&sprefix=gopro%2Caps%2C90&sr=8-12'
            },
            {
              name: 'AKASO WiFi 4K/60fps 20MP',
              image: 'https://m.media-amazon.com/images/I/71PErXGjy+L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/AKASO-Deportiva-Sumergible-Accesorios-V50/dp/B07JDHM57Y/ref=sr_1_2_sspa?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&sprefix=camara+deportiva%2Caps%2C101&sr=8-2-spons&psc=1&smid=A28MWL1CO1GVYJ&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUExUDIwM0QxQURETDk4JmVuY3J5cHRlZElkPUEwNDI3NjI0SlhZRkVFVk5JR1o3JmVuY3J5cHRlZEFkSWQ9QTA0MzQ0MDQxMEVRWVcyRTJYMUlDJndpZGdldE5hbWU9c3BfYXRmJmFjdGlvbj1jbGlja1JlZGlyZWN0JmRvTm90TG9nQ2xpY2s9dHJ1ZQ=='
            },
            {
              name: 'Apexcam 4K 20MP WiFi',
              image: 'https://m.media-amazon.com/images/I/71O7YNbGsKS._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Apexcam-subacu%C3%A1tica-Impermeable-Anti-vibraci%C3%B3n-Accesorios/dp/B07NRHF4R7/ref=sr_1_6?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&sprefix=camara+deportiva%2Caps%2C101&sr=8-6'
            },
            {
              name: 'VEMONT 1080P HD Impermeable 30M',
              image: 'https://m.media-amazon.com/images/I/710IHsn2+bL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Vemont-Deportiva-Pulgadas-Sumergible-Accesorios/dp/B07DVX1HQM/ref=sr_1_7?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&smid=A2YSSN0J8426IL&sprefix=camara+deportiva%2Caps%2C101&sr=8-7'
            },
            {
              name: 'COOAU 4K/60FPS 24MP Wi-Fi',
              image: 'https://m.media-amazon.com/images/I/61geWrdhGtL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/COOAU-Resistente-Incorporado-Antivibraci%C3%B3n-Actualizado/dp/B09V15K8TF/ref=sxin_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&content-id=amzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69%3Aamzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69&crid=22O1LRNYH4YQN&cv_ct_cx=camara+deportiva&keywords=camara+deportiva&pd_rd_i=B09V15K8TF&pd_rd_r=5a2aef04-edc5-42fb-a910-98f88f9722d5&pd_rd_w=To2kL&pd_rd_wg=UbEpw&pf_rd_p=14cc5902-455f-4809-bc8f-792c443cde69&pf_rd_r=JFKVD9GSY82PHCYG1XCQ&qid=1657648190&sprefix=camara+deportiva%2Caps%2C101&sr=1-1-b8003e8c-7dbe-4d7b-b373-a406a41b9947'
            },
            {
              name: 'LeadEdge 4K 20MP EIS',
              image: 'https://m.media-amazon.com/images/I/71kWU0g7CiL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/LeadEdge-Deportiva-Anti-Vibraci%C3%B3n-Micr%C3%B3fono-Sumergible/dp/B08KDJ5LL9/ref=sr_1_9?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&sprefix=camara+deportiva%2Caps%2C101&sr=8-9'
            },
            {
              name: 'WOLFANG GA100 4K 30FPS WiFi 20MP',
              image: 'https://m.media-amazon.com/images/I/71pFMzYa6tL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/WOLFANG-GA100-videoc%C3%A1mara-subacu%C3%A1tica-antivibraci%C3%B3n/dp/B09HGZHXJT/ref=sr_1_13?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&smid=A2H6YC7309UQPU&sprefix=camara+deportiva%2Caps%2C101&sr=8-13'
            },
            {
              name: 'Surfola 4K 30FPS WiFi 20MP',
              image: 'https://m.media-amazon.com/images/I/71tfAEv-AiL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Surfola-Videoc%C3%A1mara-Subacu%C3%A1tica-Antivibraci%C3%B3n-SF230/dp/B09LTSR28F/ref=sr_1_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=22O1LRNYH4YQN&keywords=camara+deportiva&qid=1657648190&sprefix=camara+deportiva%2Caps%2C101&sr=8-14'
            }
          ]
        },
        {
          products: [
            {
              name: 'Polaroid Now+',
              image: 'https://m.media-amazon.com/images/I/71TMYqAilWL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Polaroid-9063-Now-Azul/dp/B09CQF1SK7/ref=sr_1_10?keywords=camara%2Binstanea&qid=1657648947&sprefix=camara%2Binsta%2Caps%2C103&sr=8-10&th=1'
            },
            {
              name: 'Polaroid Go',
              image: 'https://m.media-amazon.com/images/I/71sfROyuHJL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Polaroid-9035-C%C3%A1mara-instant%C3%A1nea-Blanco/dp/B0964PSHGK/ref=sr_1_12?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-12'
            },
            {
              name: 'Kodak Printomatic',
              image: 'https://m.media-amazon.com/images/I/61cJEZaFIAL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Kodak-Printomatic-impresi%C3%B3n-instant%C3%A1nea-respaldo/dp/B07BB5FDS2/ref=sr_1_1_sspa?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-1-spons&psc=1&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUExUlcyUThaS1ZDVTZDJmVuY3J5cHRlZElkPUEwOTIzMTI3MU03VzlCTU5PQzM4TyZlbmNyeXB0ZWRBZElkPUEwNTQ4MzYzM1JKUjZVWEVFRzVPTyZ3aWRnZXROYW1lPXNwX2F0ZiZhY3Rpb249Y2xpY2tSZWRpcmVjdCZkb05vdExvZ0NsaWNrPXRydWU='
            },
            {
              name: 'Kodak C300R Mini Shot 3',
              image: 'https://m.media-amazon.com/images/I/81vPdNk-ZcL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/instant%C3%A1nea-Impresora-Cartuchos-Bluetooth-Tecnolog%C3%ADa/dp/B08HC9CRT5/ref=sr_1_2_sspa?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-2-spons&psc=1&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUExUlcyUThaS1ZDVTZDJmVuY3J5cHRlZElkPUEwOTIzMTI3MU03VzlCTU5PQzM4TyZlbmNyeXB0ZWRBZElkPUEwMTg3NTEwMklOWVlOWjJHVE5NJndpZGdldE5hbWU9c3BfYXRmJmFjdGlvbj1jbGlja1JlZGlyZWN0JmRvTm90TG9nQ2xpY2s9dHJ1ZQ=='
            },
            {
              name: 'instax Mini 11',
              image: 'https://m.media-amazon.com/images/I/71AwNMpA29L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Instax-Mini-11-C%C3%A1mara-instant%C3%A1nea/dp/B084S3Y6L1/ref=sr_1_5?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-5'
            },
            {
              name: 'Instax 16632922',
              image: 'https://m.media-amazon.com/images/I/51kFAU0cUdL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Instax-Mini-Clear-Color-Morado/dp/B07R5MMBG5/ref=sr_1_8?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-8'
            },
            {
              name: 'instax Mini 40',
              image: 'https://m.media-amazon.com/images/I/71JyybKaGPL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/instax-mini-40-C%C3%A1mara-instant%C3%A1nea/dp/B08Y5YBCY1/ref=sr_1_7?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-7'
            },
            {
              name: 'instax Square SQ1',
              image: 'https://m.media-amazon.com/images/I/71McEeVju2L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/instax-Square-SQ1-instant%C3%A1nea-Terracota/dp/B08H887HNJ/ref=sr_1_9?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-9'
            },
            {
              name: 'KODAK Step',
              image: 'https://m.media-amazon.com/images/I/81Oyw0zSkxL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/KODAK-C%C3%A1mara-Digital-Sensor-Imagen/dp/B08C6JWV24/ref=sr_1_16?keywords=camara+instanea&qid=1657648947&sprefix=camara+insta%2Caps%2C103&sr=8-16'
            },
            {
              name: 'KODAK SMILE',
              image: 'https://m.media-amazon.com/images/I/81Tr7mhytPL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/KODAK-Classic-Instant%C3%A1nea-Bluetooth-impresiones/dp/B07WHDV12K/ref=sr_1_18?keywords=camara+instanea&qid=1657648947&smid=A1AT7YVPFBWXBL&sprefix=camara+insta%2Caps%2C103&sr=8-18'
            }
          ]
        },
        {
          products: [
            {
              name: 'JOBY JB01507 GorillaPod Kit 3K',
              image: 'https://m.media-amazon.com/images/I/51YVJtmxGAL._AC_SL1081_.jpg',
              url: 'https://www.amazon.es/Joby-GorillaPod-Digitales-C%C3%A1maras-Pel%C3%ADcula/dp/B074WC9YKL/ref=sr_1_1_sspa?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1K1RZ7OW6I63Y&keywords=tripode+reflex&qid=1657649366&smid=A1AT7YVPFBWXBL&sprefix=tripode+reflex%2Caps%2C99&sr=8-1-spons&psc=1&spLa=ZW5jcnlwdGVkUXVhbGlmaWVyPUEySFZNQkM4Q01PTDJaJmVuY3J5cHRlZElkPUEwMTczNjU1M0RDQU5KQkZNS01aQSZlbmNyeXB0ZWRBZElkPUEwNTM5NDIxMVJFQ1gwTE9CSkJWTCZ3aWRnZXROYW1lPXNwX2F0ZiZhY3Rpb249Y2xpY2tSZWRpcmVjdCZkb05vdExvZ0NsaWNrPXRydWU='
            },
            {
              name: 'Victiv 185cm Aluminio',
              image: 'https://m.media-amazon.com/images/I/71+wdVDWqTL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Victiv-Aluminio-Giratorio-Desmontable-Liberaci%C3%B3n/dp/B09LHF7QVT/ref=sr_1_5?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1K1RZ7OW6I63Y&keywords=tripode+reflex&qid=1657649366&sprefix=tripode+reflex%2Caps%2C99&sr=8-5'
            },
            {
              name: 'Amazon Basics - Trípode ligero de 127 cm con funda',
              image: 'https://m.media-amazon.com/images/I/71Bl+JlWzJL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/AmazonBasics-Tr%C3%ADpode-ligero-fotograf%C3%ADa-127/dp/B00XI87KV8/ref=sr_1_6?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1K1RZ7OW6I63Y&keywords=tripode+reflex&qid=1657649366&sprefix=tripode+reflex%2Caps%2C99&sr=8-6'
            },
            {
              name: 'Manfrotto Befree Advanced GT',
              image: 'https://m.media-amazon.com/images/I/51CD+RUImzL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Manfrotto-befree-Carbon-Tr%C3%ADpode-Viaje/dp/B07GLGMBRN/ref=sxin_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&content-id=amzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69%3Aamzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69&crid=1K1RZ7OW6I63Y&cv_ct_cx=tripode+reflex&keywords=tripode+reflex&pd_rd_i=B07GLGMBRN&pd_rd_r=74605d36-8f43-4c7a-8caa-42b5ebd49674&pd_rd_w=Cje4p&pd_rd_wg=hOGOA&pf_rd_p=14cc5902-455f-4809-bc8f-792c443cde69&pf_rd_r=HDF5KXY465VAQB8NYQZB&qid=1657649366&smid=A1AT7YVPFBWXBL&sprefix=tripode+reflex%2Caps%2C99&sr=1-1-b8003e8c-7dbe-4d7b-b373-a406a41b9947'
            },
            {
              name: 'Neewer Trípode de Fibra de Carbono',
              image: 'https://m.media-amazon.com/images/I/71EmWgn6Q3L._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Neewer-Carbono-Tr%C3%ADpode-Videoc%C3%A1mara-kilogramos/dp/B01I1C8VGI/ref=sxin_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&content-id=amzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69%3Aamzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69&crid=1K1RZ7OW6I63Y&cv_ct_cx=tripode+reflex&keywords=tripode+reflex&pd_rd_i=B01I1C8VGI&pd_rd_r=74605d36-8f43-4c7a-8caa-42b5ebd49674&pd_rd_w=Cje4p&pd_rd_wg=hOGOA&pf_rd_p=14cc5902-455f-4809-bc8f-792c443cde69&pf_rd_r=HDF5KXY465VAQB8NYQZB&qid=1657649366&sprefix=tripode+reflex%2Caps%2C99&sr=1-3-b8003e8c-7dbe-4d7b-b373-a406a41b9947'
            },
            {
              name: 'K&F Concept-Trípode',
              image: 'https://m.media-amazon.com/images/I/61DpoIMpQFS._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Concept-Tel%C3%A9fono-Compatible-V%C3%ADdeoc%C3%A1mara-Transporte/dp/B07HQ5S7H6/ref=sxin_14?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&content-id=amzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69%3Aamzn1.sym.14cc5902-455f-4809-bc8f-792c443cde69&crid=1K1RZ7OW6I63Y&cv_ct_cx=tripode+reflex&keywords=tripode+reflex&pd_rd_i=B07HQ5S7H6&pd_rd_r=74605d36-8f43-4c7a-8caa-42b5ebd49674&pd_rd_w=Cje4p&pd_rd_wg=hOGOA&pf_rd_p=14cc5902-455f-4809-bc8f-792c443cde69&pf_rd_r=HDF5KXY465VAQB8NYQZB&qid=1657649366&smid=A1WO1CIAJVX0MY&sprefix=tripode+reflex%2Caps%2C99&sr=1-4-b8003e8c-7dbe-4d7b-b373-a406a41b9947'
            },
            {
              name: 'K&F Concept Trípode',
              image: 'https://m.media-amazon.com/images/I/61aUQSZqi8L._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Concept-Aluminio-Panorama-R%C3%B3tula-Liberaci%C3%B3n-para-C%C3%A1mara/dp/B0896Y9P1H/ref=sr_1_9?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1K1RZ7OW6I63Y&keywords=tripode+reflex&qid=1657649366&smid=A1WO1CIAJVX0MY&sprefix=tripode+reflex%2Caps%2C99&sr=8-9'
            },
            {
              name: 'National Geographic - Kit de Trípode',
              image: 'https://m.media-amazon.com/images/I/61gHqQt3txL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/National-Geographic-Aluminio-Liberaci%C3%B3n-NGTR002T/dp/B0825BP5HG/ref=sr_1_10?__mk_es_ES=%C3%85M%C3%85%C5%BD%C3%95%C3%91&crid=1K1RZ7OW6I63Y&keywords=tripode+reflex&qid=1657649366&smid=A1AT7YVPFBWXBL&sprefix=tripode+reflex%2Caps%2C99&sr=8-10'
            }
          ]
        },
        {
          products: [
            {
              name: 'Beschoi - Mochila para Cámara Réflex',
              image: 'https://m.media-amazon.com/images/I/61kAZhU44FL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/Beschoi-Accesorios-Fotograf%C3%ADa-Tabletas-Port%C3%A1tiles/dp/B01M4MDTNP/ref=sr_1_6?keywords=accesorios+reflex&qid=1657649898&sprefix=accesorios+refle%2Caps%2C102&sr=8-6'
            },
            {
              name: 'Neewer Mochila de cámara Acolchada',
              image: 'https://m.media-amazon.com/images/I/71e+TnTs-vL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/Neewer-acolchada-protecci%C3%B3n-disparadores-accesorios/dp/B01M5FQXFU/ref=sr_1_10?keywords=accesorios+reflex&qid=1657649898&sprefix=accesorios+refle%2Caps%2C102&sr=8-10'
            },
            {
              name: 'USA Gear DSLR Funda Cámara Reflex',
              image: 'https://m.media-amazon.com/images/I/81rg2hVZflL._AC_SL1500_.jpg',
              url: 'https://www.amazon.es/USA-Gear-protecci%C3%B3n-almacenamiento-accesorios/dp/B07SV4MGWZ/ref=sr_1_11?keywords=accesorios+reflex&qid=1657649898&sprefix=accesorios+refle%2Caps%2C102&sr=8-11'
            },
            {
              name: 'CADeN Bolsa Bandolera Camara Reflex',
              image: 'https://m.media-amazon.com/images/I/61427gr5xSL._AC_SL1001_.jpg',
              url: 'https://www.amazon.es/CADeN-Bolsa-Bandolera-Camara-Reflex/dp/B07HNPPHRC/ref=sr_1_7?keywords=accesorios+reflex&qid=1657649898&sprefix=accesorios+refle%2Caps%2C102&sr=8-7'
            },
            {
              name: 'Zacro 49 en 1 Kits Limpieza Cámara Reflex',
              image: 'https://m.media-amazon.com/images/I/71Lv2UB3ECL._AC_SL1490_.jpg',
              url: 'https://www.amazon.es/Zacro-Limpieza-Profesional-Digitales-Impermeable/dp/B07RSTLWLT/ref=sr_1_5?keywords=accesorios+reflex&qid=1657649898&sprefix=accesorios+refle%2Caps%2C102&sr=8-5'
            },
            {
              name: 'K&F Concept-Kit de Limpieza Camara Completo 23 en 1',
              image: 'https://m.media-amazon.com/images/I/71xp9yQCDqL._AC_SL1000_.jpg',
              url: 'https://www.amazon.es/dp/B08HLJSRGQ?pd_rd_i=B08HLJSRGQ&pf_rd_p=fbf47ff3-081c-4842-be54-46d1ab576b91&pf_rd_r=R79W4341XBHDMPDTAM29&pd_rd_wg=hOhzO&pd_rd_w=Z5WkH&pd_rd_r=3e28c8cd-9bbe-41f9-aa8a-1a427efc4d83'
            }
          ]
        }
      ],
      finalProductsList: []
    }
  },
  components: {
    ProductItem
  },
  mounted() {
    this.getProductsList();
  },
  methods: {
    getProductsList() {
      this.finalProductsList = this.productsList[this.idProducts -1].products;
    }
  }
}
</script>

<style scoped>
.products {
  padding: 10px;
  padding-top: 70px;
  padding-bottom: 90px;
}

.items-container {
  max-width: 1000px;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-wrap: wrap;
  margin: 0 auto;
}

@media (min-width: 768px) {
  .products-text {
    margin-top: 40px;
    margin-bottom: 40px;
  }
}
</style>