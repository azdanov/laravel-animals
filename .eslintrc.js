module.exports = {
  extends: ['plugin:vue/recommended', 'plugin:prettier/recommended', 'prettier/vue'],
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  plugins: ['vue'],
  rules: {
    'vue/camelcase': 1,
    'vue/eqeqeq': 1,
    'vue/component-name-in-template-casing': [
      1,
      'PascalCase',
      {
        registeredComponentsOnly: false,
        ignores: [],
      },
    ],
  },
}
