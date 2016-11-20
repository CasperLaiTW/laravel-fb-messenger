/**
 * Created by casperlai on 2016/11/20.
 */

module.exports = {
  entry: {
    dist: './resources/assets/js/bootstrap',
  },
  output: {
    path: './public/fb-messenger/',
    filename: '[name].js',
  },
  resolve: {
    extensions: ['', '.js'],
    alias: {
      'vue$': 'vue/dist/vue',
    },
  },
  module: {
    loaders: [
      {
        test: /\.js$/,
        loader: 'babel',
        exclude: /node_modules/,
      },
      {
        test: /\.vue$/,
        loader: 'vue',
      },
    ],
  },
};