<template>
  <div>
    <nav id="navbar" class="bd-navbar navbar has-shadow is-spaced">
      <div class="container">
        <div class="navbar-brand">
          <nuxt-link class="navbar-item" to="/">
            <img
              src="~@/assets/images/logo.png"
              alt="logo"
              width="112"
              height="28"
            />
          </nuxt-link>
          <p class="is-size-7 disc">
            今日のことばを共有するプラットホーム
          </p>
        </div>
        <div class="navbar-end">
          <nuxt-link
            class="navbar-item is-size-7 has-text-weight-semibold"
            to="/message"
          >
            <span class="icon has-text-primary">
              <i class="fa fa-comment"></i>
            </span>
            ことば一覧
          </nuxt-link>
        </div>
      </div>
    </nav>
    <nuxt />
  </div>
</template>

<style lang="scss">
html {
  font-family: 'Source Sans Pro', -apple-system, BlinkMacSystemFont, 'Segoe UI',
    Roboto, 'Helvetica Neue', Arial, sans-serif;
  font-size: 16px;
  word-spacing: 1px;
  -ms-text-size-adjust: 100%;
  -webkit-text-size-adjust: 100%;
  -moz-osx-font-smoothing: grayscale;
  -webkit-font-smoothing: antialiased;
  box-sizing: border-box;
}

*,
*::before,
*::after {
  box-sizing: border-box;
  margin: 0;
}

.navbar-brand {
  align-items: center;
}

.disc {
  margin-left: 10px;
  margin-top: 10px;
  display: none;
  @media screen and (min-width: $tablet) {
    display: block;
  }
}
#navbar .container {
  @media screen and (max-width: $mobile) {
    display: flex;
    align-items: center;
    .navbar-end {
      margin-left: auto;
    }
  }
}
</style>
