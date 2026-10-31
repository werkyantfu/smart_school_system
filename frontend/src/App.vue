<template>
  <div class="app-container">
    <router-view />
  </div>
</template>

<style>
body {
  margin: 0;
  padding: 0;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  overflow: hidden; 
  height: 100vh;
}
.app-container {
  height: 100vh;
  display: flex;
  flex-direction: column;
}
</style>