<script>

export default {
  name: 'AppHeader',
}

</script>


<template>
  <div class="aaa">
      HEADER
      <router-link :to="{ name: 'Restaurants' }" class="cerca" > <a >cerca</a> </router-link>
  </div>
</template>

<style scoped lang="scss">
  .aaa {
      border: 1px solid black;
      border-radius:  3px;
      height: 100px;
      width: 80%;
      margin: 0 auto;
      // background-color: blue;
      
  };

  .cerca{
    text-decoration-line: none;
    color: black;
    
  }


</style>
