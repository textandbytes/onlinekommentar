module.exports = {
  methods: {
    /**
     * Translate the given key.
     */
    __(key, replace = {}) {
      let translation = this.$page.props.translations[key]
        ? this.$page.props.translations[key]
        : key

      Object.keys(replace).forEach(function (key) {
        translation = translation.replace(':' + key, replace[key])
      })

      return translation
    }
  }
}