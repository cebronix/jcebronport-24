const { defineConfig } = require('@vue/cli-service')
module.exports = defineConfig({
  transpileDependencies: true,
  publicPath: '',
  productionSourceMap: false,
  chainWebpack : (config) => {
    config.output.filename('[name].js');
  },
  css: {
    extract: {
      filename: '[name].css',
      chunkFilename: '[name].css'
    }
  }
})
