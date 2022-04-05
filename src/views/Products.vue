<template>
  <div class="products">
    <p class="products-text">Esta es nuestra selección de productos recomendados relacionados con la fotografía</p>
    <div class="items-container">
      <ProductItem 
        urlImage='https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg'
        name='Canon EOS 2000D'
        url="https://www.amazon.es/Canon-Camera-2000d-55-III-2728-l50-c002/dp/B07BMV268V/ref=sr_1_2?adgrpid=56496329259&gclid=CjwKCAjw0a-SBhBkEiwApljU0n6dTI-B0Tba8et1yiHiai7LyMibDlmoQONEXukxMEeywG9rUyNy2RoCTfoQAvD_BwE&hvadid=275299138443&hvdev=c&hvlocphy=1005527&hvnetw=g&hvqmt=e&hvrand=15356051861543746136&hvtargid=kwd-342981820748&hydadcr=11893_1831461&keywords=canon+eos+2000d&qid=1649180188&sr=8-2"
      />
      <ProductItem 
        urlImage='https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg'
        name='Canon EOS 2000D'
        url="https://www.amazon.es/Canon-Camera-2000d-55-III-2728-l50-c002/dp/B07BMV268V/ref=sr_1_2?adgrpid=56496329259&gclid=CjwKCAjw0a-SBhBkEiwApljU0n6dTI-B0Tba8et1yiHiai7LyMibDlmoQONEXukxMEeywG9rUyNy2RoCTfoQAvD_BwE&hvadid=275299138443&hvdev=c&hvlocphy=1005527&hvnetw=g&hvqmt=e&hvrand=15356051861543746136&hvtargid=kwd-342981820748&hydadcr=11893_1831461&keywords=canon+eos+2000d&qid=1649180188&sr=8-2"
      />
      <ProductItem 
        urlImage='https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg'
        name='Canon EOS 2000D'
        url="https://www.amazon.es/Canon-Camera-2000d-55-III-2728-l50-c002/dp/B07BMV268V/ref=sr_1_2?adgrpid=56496329259&gclid=CjwKCAjw0a-SBhBkEiwApljU0n6dTI-B0Tba8et1yiHiai7LyMibDlmoQONEXukxMEeywG9rUyNy2RoCTfoQAvD_BwE&hvadid=275299138443&hvdev=c&hvlocphy=1005527&hvnetw=g&hvqmt=e&hvrand=15356051861543746136&hvtargid=kwd-342981820748&hydadcr=11893_1831461&keywords=canon+eos+2000d&qid=1649180188&sr=8-2"
      />
      <ProductItem 
        urlImage='https://m.media-amazon.com/images/I/41Xn25rH9xL._AC_.jpg'
        name='Canon EOS 2000D'
        url="https://www.amazon.es/Canon-Camera-2000d-55-III-2728-l50-c002/dp/B07BMV268V/ref=sr_1_2?adgrpid=56496329259&gclid=CjwKCAjw0a-SBhBkEiwApljU0n6dTI-B0Tba8et1yiHiai7LyMibDlmoQONEXukxMEeywG9rUyNy2RoCTfoQAvD_BwE&hvadid=275299138443&hvdev=c&hvlocphy=1005527&hvnetw=g&hvqmt=e&hvrand=15356051861543746136&hvtargid=kwd-342981820748&hydadcr=11893_1831461&keywords=canon+eos+2000d&qid=1649180188&sr=8-2"
      />
    </div>
  </div>
</template>

<script>
import ProductItem from '../components/ProductItem.vue';

export default {
  data() {
    return {

    }
  },
  components: {
    ProductItem
  },
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
  justify-content: space-around;
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