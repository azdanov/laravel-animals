(window["webpackJsonp"] = window["webpackJsonp"] || []).push([[0],{

/***/ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/CategoryModify.vue?vue&type=script&lang=js&":
/*!*************************************************************************************************************************************************************************!*\
  !*** ./node_modules/babel-loader/lib??ref--4-0!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/CategoryModify.vue?vue&type=script&lang=js& ***!
  \*************************************************************************************************************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! @babel/runtime/regenerator */ "./node_modules/@babel/runtime/regenerator/index.js");
/* harmony import */ var _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _api__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ../api */ "./resources/js/api.js");


function asyncGeneratorStep(gen, resolve, reject, _next, _throw, key, arg) { try { var info = gen[key](arg); var value = info.value; } catch (error) { reject(error); return; } if (info.done) { resolve(value); } else { Promise.resolve(value).then(_next, _throw); } }

function _asyncToGenerator(fn) { return function () { var self = this, args = arguments; return new Promise(function (resolve, reject) { var gen = fn.apply(self, args); function _next(value) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "next", value); } function _throw(err) { asyncGeneratorStep(gen, resolve, reject, _next, _throw, "throw", err); } _next(undefined); }); }; }

//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//
//

/* harmony default export */ __webpack_exports__["default"] = ({
  name: 'CategoryModify',
  props: {
    slug: {
      type: String,
      default: null
    }
  },
  data: function data() {
    return {
      done: false,
      form: {
        name: '',
        description: '',
        image: '',
        display_order: ''
      },
      errors: {
        name: '',
        description: '',
        image: '',
        display_order: ''
      },
      dropzoneOptions: {
        url: '/api/images',
        thumbnailWidth: 200,
        thumbnailHeight: 120,
        thumbnailMethod: 'contain',
        addRemoveLinks: true,
        withCredentials: true,
        maxFiles: 1,
        headers: _api__WEBPACK_IMPORTED_MODULE_1__["headers"]
      }
    };
  },
  mounted: function mounted() {
    this.initDropZone();
  },
  methods: {
    initDropZone: function initDropZone() {
      var _this = this;

      if (!this.slug) return;
      var category = this.$store.getters.category(this.slug);

      if (category) {
        this.form = Object.assign({}, this.form, category);
        this.fetchThumbnail();
      } else {
        var unwatch = this.$store.watch(function (state) {
          return state.categories;
        }, function () {
          _this.form = Object.assign({}, _this.form, _this.$store.getters.category(_this.slug));

          _this.fetchThumbnail();

          unwatch();
        });
      }
    },
    fetchThumbnail: function fetchThumbnail() {
      var _this2 = this;

      _api__WEBPACK_IMPORTED_MODULE_1__["http"].get("/images/".concat(this.form.image)).then(function (res) {
        return res.blob();
      }).then(function (res) {
        var file = {
          name: _this2.form.image,
          size: res.size,
          type: res.type
          /**
           * FIXME: Doesn't support SVG
           * @see https://github.com/rowanwins/vue-dropzone/pull/434
           */

        };

        _this2.$refs.dropzone.manuallyAddFile(file, "/images/".concat(_this2.form.image));
      });
    },
    addLastOnly: function addLastOnly(file) {
      this.$refs.dropzone.removeAllFiles();
      this.$refs.dropzone.addFile(file);
    },
    remove: function () {
      var _remove = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee() {
        var _this3 = this;

        var res;
        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee$(_context) {
          while (1) {
            switch (_context.prev = _context.next) {
              case 0:
                if (!(this.done || this.slug)) {
                  _context.next = 2;
                  break;
                }

                return _context.abrupt("return");

              case 2:
                _context.next = 4;
                return _api__WEBPACK_IMPORTED_MODULE_1__["default"].delete("images/".concat(this.form.image)).text();

              case 4:
                res = _context.sent;
                console.log(res);
                this.$store.state.categories.forEach(function (c) {
                  if (_this3.$slugify(c.name) === _this3.slug) {
                    c.image = '';
                  }
                });
                this.form.image = '';

              case 8:
              case "end":
                return _context.stop();
            }
          }
        }, _callee, this);
      }));

      function remove() {
        return _remove.apply(this, arguments);
      }

      return remove;
    }(),
    success: function success(file, response) {
      this.errors.image = '';
      this.form.image = response.message;
    },
    submit: function () {
      var _submit = _asyncToGenerator(
      /*#__PURE__*/
      _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.mark(function _callee2() {
        var _this4 = this;

        var res, message, _this$$store$getters$, id, _res;

        return _babel_runtime_regenerator__WEBPACK_IMPORTED_MODULE_0___default.a.wrap(function _callee2$(_context2) {
          while (1) {
            switch (_context2.prev = _context2.next) {
              case 0:
                _context2.prev = 0;

                if (!this.slug) {
                  _context2.next = 9;
                  break;
                }

                _this$$store$getters$ = this.$store.getters.category(this.slug), id = _this$$store$getters$.id;
                _context2.next = 5;
                return _api__WEBPACK_IMPORTED_MODULE_1__["default"].put("categories/".concat(id), {
                  json: this.form
                }).json();

              case 5:
                res = _context2.sent;
                message = "".concat(this.form.name, " has been updated.");
                _context2.next = 13;
                break;

              case 9:
                _context2.next = 11;
                return _api__WEBPACK_IMPORTED_MODULE_1__["default"].post('categories', {
                  json: this.form
                }).json();

              case 11:
                res = _context2.sent;
                message = "".concat(this.form.name, " has been added.");

              case 13:
                _context2.next = 23;
                break;

              case 15:
                _context2.prev = 15;
                _context2.t0 = _context2["catch"](0);
                _context2.next = 19;
                return _context2.t0.response.json();

              case 19:
                _res = _context2.sent;
                this.errors = Object.assign({}, this.errors, _res.errors);
                this.$toast.open({
                  message: _res.message,
                  type: 'is-danger',
                  position: 'is-bottom'
                });
                return _context2.abrupt("return");

              case 23:
                this.done = true;
                _context2.next = 26;
                return this.$store.dispatch('fetchCategories');

              case 26:
                this.$router.push("/categories/".concat(this.$slugify(this.form.name)), function () {
                  _this4.$toast.open({
                    message: message,
                    type: 'is-success',
                    position: 'is-bottom'
                  });
                });

              case 27:
              case "end":
                return _context2.stop();
            }
          }
        }, _callee2, this, [[0, 15]]);
      }));

      function submit() {
        return _submit.apply(this, arguments);
      }

      return submit;
    }()
  }
});

/***/ }),

/***/ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83&":
/*!*****************************************************************************************************************************************************************************************************************!*\
  !*** ./node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!./node_modules/vue-loader/lib??vue-loader-options!./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83& ***!
  \*****************************************************************************************************************************************************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "render", function() { return render; });
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return staticRenderFns; });
var render = function() {
  var _vm = this
  var _h = _vm.$createElement
  var _c = _vm._self._c || _h
  return _c(
    "form",
    {
      on: {
        submit: function($event) {
          $event.preventDefault()
          return _vm.submit($event)
        }
      }
    },
    [
      _c(
        "b-field",
        {
          attrs: {
            horizontal: "",
            label: "Name",
            "label-for": "name",
            type: _vm.errors.name ? "is-danger" : "",
            message: _vm.errors.name[0]
          }
        },
        [
          _c("b-input", {
            attrs: {
              id: "name",
              name: "name",
              placeholder: "Category name",
              required: "",
              expanded: ""
            },
            on: {
              blur: function($event) {
                _vm.errors.name = ""
              }
            },
            model: {
              value: _vm.form.name,
              callback: function($$v) {
                _vm.$set(_vm.form, "name", $$v)
              },
              expression: "form.name"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-field",
        {
          attrs: {
            horizontal: "",
            label: "Description",
            "label-for": "description",
            type: _vm.errors.description ? "is-danger" : "",
            message: _vm.errors.description[0]
          }
        },
        [
          _c("b-input", {
            attrs: {
              id: "description",
              name: "description",
              placeholder: "Description for this category",
              required: "",
              expanded: "",
              type: "textarea"
            },
            on: {
              blur: function($event) {
                _vm.errors.description = ""
              }
            },
            model: {
              value: _vm.form.description,
              callback: function($$v) {
                _vm.$set(_vm.form, "description", $$v)
              },
              expression: "form.description"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-field",
        {
          attrs: {
            horizontal: "",
            label: "Display Order",
            "label-for": "display_order",
            type: _vm.errors.display_order ? "is-danger" : "",
            message: _vm.errors.display_order[0]
          }
        },
        [
          _c("b-input", {
            attrs: {
              id: "display_order",
              name: "display_order",
              placeholder: "Order of this category",
              required: "",
              expanded: "",
              type: "number",
              min: "1"
            },
            on: {
              blur: function($event) {
                _vm.errors.display_order = ""
              }
            },
            model: {
              value: _vm.form.display_order,
              callback: function($$v) {
                _vm.$set(_vm.form, "display_order", $$v)
              },
              expression: "form.display_order"
            }
          })
        ],
        1
      ),
      _vm._v(" "),
      _c(
        "b-field",
        {
          attrs: {
            horizontal: "",
            label: "Image",
            "label-for": "image",
            type: _vm.errors.image ? "is-danger" : "",
            message: _vm.errors.image[0]
          }
        },
        [
          _c(
            "drop-zone",
            {
              ref: "dropzone",
              class: [_vm.errors.image ? "is-danger" : ""],
              attrs: {
                id: "image",
                options: _vm.dropzoneOptions,
                "use-custom-slot": true
              },
              on: {
                "vdropzone-max-files-exceeded": _vm.addLastOnly,
                "vdropzone-success": _vm.success,
                "vdropzone-removed-file": _vm.remove
              }
            },
            [
              _c("p", { staticClass: "has-text-left" }, [
                _vm._v("Select a category image to upload")
              ])
            ]
          )
        ],
        1
      ),
      _vm._v(" "),
      _c("b-field", { attrs: { horizontal: "" } }, [
        _c("p", { staticClass: "control" }, [
          _c("button", { staticClass: "button is-link is-outlined" }, [
            _vm._v(
              "\n        " +
                _vm._s(_vm.slug ? "Save" : "Add") +
                " Category\n      "
            )
          ])
        ])
      ])
    ],
    1
  )
}
var staticRenderFns = []
render._withStripped = true



/***/ }),

/***/ "./resources/js/components/CategoryModify.vue":
/*!****************************************************!*\
  !*** ./resources/js/components/CategoryModify.vue ***!
  \****************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./CategoryModify.vue?vue&type=template&id=3c57ea83& */ "./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83&");
/* harmony import */ var _CategoryModify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./CategoryModify.vue?vue&type=script&lang=js& */ "./resources/js/components/CategoryModify.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport *//* harmony import */ var _node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ../../../node_modules/vue-loader/lib/runtime/componentNormalizer.js */ "./node_modules/vue-loader/lib/runtime/componentNormalizer.js");





/* normalize component */

var component = Object(_node_modules_vue_loader_lib_runtime_componentNormalizer_js__WEBPACK_IMPORTED_MODULE_2__["default"])(
  _CategoryModify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_1__["default"],
  _CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__["render"],
  _CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"],
  false,
  null,
  null,
  null
  
)

/* hot reload */
if (false) { var api; }
component.options.__file = "resources/js/components/CategoryModify.vue"
/* harmony default export */ __webpack_exports__["default"] = (component.exports);

/***/ }),

/***/ "./resources/js/components/CategoryModify.vue?vue&type=script&lang=js&":
/*!*****************************************************************************!*\
  !*** ./resources/js/components/CategoryModify.vue?vue&type=script&lang=js& ***!
  \*****************************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryModify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/babel-loader/lib??ref--4-0!../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryModify.vue?vue&type=script&lang=js& */ "./node_modules/babel-loader/lib/index.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/CategoryModify.vue?vue&type=script&lang=js&");
/* empty/unused harmony star reexport */ /* harmony default export */ __webpack_exports__["default"] = (_node_modules_babel_loader_lib_index_js_ref_4_0_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryModify_vue_vue_type_script_lang_js___WEBPACK_IMPORTED_MODULE_0__["default"]); 

/***/ }),

/***/ "./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83&":
/*!***********************************************************************************!*\
  !*** ./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83& ***!
  \***********************************************************************************/
/*! exports provided: render, staticRenderFns */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! -!../../../node_modules/vue-loader/lib/loaders/templateLoader.js??vue-loader-options!../../../node_modules/vue-loader/lib??vue-loader-options!./CategoryModify.vue?vue&type=template&id=3c57ea83& */ "./node_modules/vue-loader/lib/loaders/templateLoader.js?!./node_modules/vue-loader/lib/index.js?!./resources/js/components/CategoryModify.vue?vue&type=template&id=3c57ea83&");
/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "render", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__["render"]; });

/* harmony reexport (safe) */ __webpack_require__.d(__webpack_exports__, "staticRenderFns", function() { return _node_modules_vue_loader_lib_loaders_templateLoader_js_vue_loader_options_node_modules_vue_loader_lib_index_js_vue_loader_options_CategoryModify_vue_vue_type_template_id_3c57ea83___WEBPACK_IMPORTED_MODULE_0__["staticRenderFns"]; });



/***/ })

}]);