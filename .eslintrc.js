module.exports = {
  extends: ['plugin:vue/recommended', 'plugin:prettier/recommended', 'prettier/vue'],
  parserOptions: {
    parser: 'babel-eslint',
    ecmaVersion: 2018,
    sourceType: 'module',
  },
  plugins: ['vue', 'sort-imports-es6-autofix'],
  rules: {
    'vue/camelcase': 1,
    'vue/component-name-in-template-casing': [
      1,
      'kebab-case',
      {
        registeredComponentsOnly: false,
        ignores: [],
      },
    ],
    'prefer-template': 1,
    'prefer-const': 1,
    'sort-imports-es6-autofix/sort-imports-es6': [
      1,
      {
        ignoreCase: false,
        ignoreMemberSort: false,
        memberSyntaxSortOrder: ['none', 'all', 'multiple', 'single'],
      },
    ],
  },
}
