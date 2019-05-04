/*!
 * froala_editor v2.7.2 (https://www.froala.com/wysiwyg-editor)
 * License https://froala.com/wysiwyg-editor/terms/
 * Copyright 2014-2017 Froala Labs
 */

! function(a) { "function" == typeof define && define.amd ? define(["jquery"], a) : "object" == typeof module && module.exports ? module.exports = function(b, c) { return void 0 === c && (c = "undefined" != typeof window ? require("jquery") : require("jquery")(b)), a(c) } : a(window.jQuery) }(function(a) {
    var b = function(c, d) { this.id = ++a.FE.ID, this.opts = a.extend(!0, {}, a.extend({}, b.DEFAULTS, "object" == typeof d && d)); var e = JSON.stringify(this.opts);
        a.FE.OPTS_MAPPING[e] = a.FE.OPTS_MAPPING[e] || this.id, this.sid = a.FE.OPTS_MAPPING[e], a.FE.SHARED[this.sid] = a.FE.SHARED[this.sid] || {}, this.shared = a.FE.SHARED[this.sid], this.shared.count = (this.shared.count || 0) + 1, this.$oel = a(c), this.$oel.data("froala.editor", this), this.o_doc = c.ownerDocument, this.o_win = "defaultView" in this.o_doc ? this.o_doc.defaultView : this.o_doc.parentWindow; var f = a(this.o_win).scrollTop();
        this.$oel.on("froala.doInit", a.proxy(function() { this.$oel.off("froala.doInit"), this.doc = this.$el.get(0).ownerDocument, this.win = "defaultView" in this.doc ? this.doc.defaultView : this.doc.parentWindow, this.$doc = a(this.doc), this.$win = a(this.win), this.opts.pluginsEnabled || (this.opts.pluginsEnabled = Object.keys(a.FE.PLUGINS)), this.opts.initOnClick ? (this.load(a.FE.MODULES), this.$el.on("touchstart.init", function() { a(this).data("touched", !0) }), this.$el.on("touchmove.init", function() { a(this).removeData("touched") }), this.$el.on("mousedown.init touchend.init dragenter.init focus.init", a.proxy(function(b) { if ("touchend" == b.type && !this.$el.data("touched")) return !0; if (1 === b.which || !b.which) { this.$el.off("mousedown.init touchstart.init touchmove.init touchend.init dragenter.init focus.init"), this.load(a.FE.MODULES), this.load(a.FE.PLUGINS); var c = b.originalEvent && b.originalEvent.originalTarget;
                    c && "IMG" == c.tagName && a(c).trigger("mousedown"), "undefined" == typeof this.ul && this.destroy(), "touchend" == b.type && this.image && b.originalEvent && b.originalEvent.target && a(b.originalEvent.target).is("img") && setTimeout(a.proxy(function() { this.image.edit(a(b.originalEvent.target)) }, this), 100), this.ready = !0, this.events.trigger("initialized") } }, this)), this.events.trigger("initializationDelayed")) : (this.load(a.FE.MODULES), this.load(a.FE.PLUGINS), a(this.o_win).scrollTop(f), "undefined" == typeof this.ul && this.destroy(), this.ready = !0, this.events.trigger("initialized")) }, this)), this._init() };
    b.DEFAULTS = { initOnClick: !1, pluginsEnabled: null }, b.MODULES = {}, b.PLUGINS = {}, b.VERSION = "2.7.2", b.INSTANCES = [], b.OPTS_MAPPING = {}, b.SHARED = {}, b.ID = 0, b.prototype._init = function() { var b = this.$oel.prop("tagName");
        this.$oel.closest("label").length >= 1 && console.warn("Note! It is not recommended to initialize the Froala Editor within a label tag."); var c = a.proxy(function() { "TEXTAREA" != b && (this._original_html = this._original_html || this.$oel.html()), this.$box = this.$box || this.$oel, this.opts.fullPage && (this.opts.iframe = !0), this.opts.iframe ? (this.$iframe = a('<iframe src="about:blank" frameBorder="0">'), this.$wp = a("<div></div>"), this.$box.html(this.$wp), this.$wp.append(this.$iframe), this.$iframe.get(0).contentWindow.document.open(), this.$iframe.get(0).contentWindow.document.write("<!DOCTYPE html>"), this.$iframe.get(0).contentWindow.document.write("<html><head></head><body></body></html>"), this.$iframe.get(0).contentWindow.document.close(), this.$el = this.$iframe.contents().find("body"), this.el = this.$el.get(0), this.$head = this.$iframe.contents().find("head"), this.$html = this.$iframe.contents().find("html"), this.iframe_document = this.$iframe.get(0).contentWindow.document, this.$oel.trigger("froala.doInit")) : (this.$el = a("<div></div>"), this.el = this.$el.get(0), this.$wp = a("<div></div>").append(this.$el), this.$box.html(this.$wp), this.$oel.trigger("froala.doInit")) }, this),
            d = a.proxy(function() { this.$box = a("<div>"), this.$oel.before(this.$box).hide(), this._original_html = this.$oel.val(), this.$oel.parents("form").on("submit." + this.id, a.proxy(function() { this.events.trigger("form.submit") }, this)), this.$oel.parents("form").on("reset." + this.id, a.proxy(function() { this.events.trigger("form.reset") }, this)), c() }, this),
            e = a.proxy(function() { this.$el = this.$oel, this.el = this.$el.get(0), this.$el.attr("contenteditable", !0).css("outline", "none").css("display", "inline-block"), this.opts.multiLine = !1, this.opts.toolbarInline = !1, this.$oel.trigger("froala.doInit") }, this),
            f = a.proxy(function() { this.$el = this.$oel, this.el = this.$el.get(0), this.opts.toolbarInline = !1, this.$oel.trigger("froala.doInit") }, this),
            g = a.proxy(function() { this.$el = this.$oel, this.el = this.$el.get(0), this.opts.toolbarInline = !1, this.$oel.on("click.popup", function(a) { a.preventDefault() }), this.$oel.trigger("froala.doInit") }, this);
        this.opts.editInPopup ? g() : "TEXTAREA" == b ? d() : "A" == b ? e() : "IMG" == b ? f() : "BUTTON" == b || "INPUT" == b ? (this.opts.editInPopup = !0, this.opts.toolbarInline = !1, g()) : c() }, b.prototype.load = function(b) { for (var c in b)
            if (b.hasOwnProperty(c)) { if (this[c]) continue; if (a.FE.PLUGINS[c] && this.opts.pluginsEnabled.indexOf(c) < 0) continue; if (this[c] = new b[c](this), this[c]._init && (this[c]._init(), this.opts.initOnClick && "core" == c)) return !1 } }, b.prototype.destroy = function() { this.shared.count--, this.events.$off(); var b = this.html.get(); if (this.events.trigger("destroy", [], !0), this.events.trigger("shared.destroy", void 0, !0), 0 === this.shared.count) { for (var c in this.shared) this.shared.hasOwnProperty(c) && (null == this.shared[c], a.FE.SHARED[this.sid][c] = null);
            a.FE.SHARED[this.sid] = {} } this.$oel.parents("form").off("." + this.id), this.$oel.off("click.popup"), this.$oel.removeData("froala.editor"), this.$oel.off("froalaEditor"), this.core.destroy(b), a.FE.INSTANCES.splice(a.FE.INSTANCES.indexOf(this), 1) }, a.fn.froalaEditor = function(c) { for (var d = [], e = 0; e < arguments.length; e++) d.push(arguments[e]); if ("string" == typeof c) { var f = []; return this.each(function() { var b = a(this),
                    e = b.data("froala.editor"); if (!e) return console.warn("Editor should be initialized before calling the " + c + " method."); var g, h; if (c.indexOf(".") > 0 && e[c.split(".")[0]] ? (e[c.split(".")[0]] && (g = e[c.split(".")[0]]), h = c.split(".")[1]) : (g = e, h = c.split(".")[0]), !g[h]) return a.error("Method " + c + " does not exist in Froala Editor."); var i = g[h].apply(e, d.slice(1));
                void 0 === i ? f.push(this) : 0 === f.length && f.push(i) }), 1 == f.length ? f[0] : f } if ("object" == typeof c || !c) return this.each(function() { var d = a(this).data("froala.editor"); if (!d) { var e = this;
                new b(e, c) } }) }, a.fn.froalaEditor.Constructor = b, a.FroalaEditor = b, a.FE = b, a.FE.XS = 0, a.FE.SM = 1, a.FE.MD = 2, a.FE.LG = 3;
    var c = "a-z\\u0080-\\u009f\\u00a1-\\uffff0-9-_";
    a.FE.LinkRegExCommon = "(([" + c + "])|([" + c + "](\\.|-|_|--))){1,}[" + c + "]{1,}", a.FE.LinkRegExEnd = "((:[0-9]{1,5})|)(((\\/|\\?|#)[a-z\\u00a1-\\uffff0-9@?\\|!^=%&amp;/~+#-_{}]*)|())", a.FE.LinkRegExTLD = "((" + a.FE.LinkRegExCommon + ")(\\.(com|net|org|edu|mil|gov|co|biz|info|me|dev)))", a.FE.LinkRegExHTTP = "((ftp|http|https):\\/\\/" + a.FE.LinkRegExCommon + ")", a.FE.LinkRegExAuth = "((ftp|http|https):\\/\\/[\\u0021-\\uffff]{1,}@" + a.FE.LinkRegExCommon + ")", a.FE.LinkRegExWWW = "(www\\." + a.FE.LinkRegExCommon + "\\.[a-z0-9-]{2,24})", a.FE.LinkRegEx = "(" + a.FE.LinkRegExTLD + "|" + a.FE.LinkRegExHTTP + "|" + a.FE.LinkRegExWWW + "|" + a.FE.LinkRegExAuth + ")" + a.FE.LinkRegExEnd, a.FE.LinkProtocols = ["mailto", "tel", "sms", "notes", "data"], a.FE.MAIL_REGEX = /.+@.+\..+/i, a.FE.MODULES.helpers = function(b) {
        function c() { var a, b, c = -1; return "Microsoft Internet Explorer" == navigator.appName ? (a = navigator.userAgent, b = new RegExp("MSIE ([0-9]{1,}[\\.0-9]{0,})"), null !== b.exec(a) && (c = parseFloat(RegExp.$1))) : "Netscape" == navigator.appName && (a = navigator.userAgent, b = new RegExp("Trident/.*rv:([0-9]{1,}[\\.0-9]{0,})"), null !== b.exec(a) && (c = parseFloat(RegExp.$1))), c }

        function d() { var a = {},
                b = c(); if (b > 0) a.msie = !0;
            else { var d = navigator.userAgent.toLowerCase(),
                    e = /(edge)[ \/]([\w.]+)/.exec(d) || /(chrome)[ \/]([\w.]+)/.exec(d) || /(webkit)[ \/]([\w.]+)/.exec(d) || /(opera)(?:.*version|)[ \/]([\w.]+)/.exec(d) || /(msie) ([\w.]+)/.exec(d) || d.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec(d) || [],
                    f = { browser: e[1] || "", version: e[2] || "0" };
                e[1] && (a[f.browser] = !0), a.chrome ? a.webkit = !0 : a.webkit && (a.safari = !0) } return a.msie && (a.version = b), a }

        function e() { return /(iPad|iPhone|iPod)/g.test(navigator.userAgent) && !h() }

        function f() { return /(Android)/g.test(navigator.userAgent) && !h() }

        function g() { return /(Blackberry)/g.test(navigator.userAgent) }

        function h() { return /(Windows Phone)/gi.test(navigator.userAgent) }

        function i() { return f() || e() || g() }

        function j() { return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || function(a) { window.setTimeout(a, 1e3 / 60) } }

        function k(a) { return parseInt(a, 10) || 0 }

        function l() { var b = a('<div class="fr-visibility-helper"></div>').appendTo("body:first"); try { var c = k(b.css("margin-left")); return b.remove(), c } catch (d) { return a.FE.LG } }

        function m() { return "ontouchstart" in window || window.DocumentTouch && document instanceof DocumentTouch }

        function n(b) { if (!/^(https?:|ftps?:|)\/\//i.test(b)) return !1;
            b = String(b).replace(/</g, "%3C").replace(/>/g, "%3E").replace(/"/g, "%22").replace(/ /g, "%20"); var c = new RegExp("^" + a.FE.LinkRegEx + "$", "gi"); return c.test(b) }

        function o(b) { return !/^(https?:|ftps?:|)\/\//i.test(b) && a.FE.MAIL_REGEX.test(b) }

        function p(b) { var c = /^([A-Za-z]:(\\){1,2}|[A-Za-z]:((\\){1,2}[^\\]+)+)(\\)?$/i; if (c.test(b)) return b; if (/^(https?:|ftps?:|)\/\//i.test(b)) { if (!n(b) && !n("http:" + b)) return "" } else { if (new RegExp("^(" + a.FE.LinkProtocols.join("|") + "):\\/\\/", "i").test(b)) return b;
                b = encodeURIComponent(b).replace(/%23/g, "#").replace(/%2F/g, "/").replace(/%25/g, "%").replace(/mailto%3A/gi, "mailto:").replace(/file%3A/gi, "file:").replace(/sms%3A/gi, "sms:").replace(/tel%3A/gi, "tel:").replace(/notes%3A/gi, "notes:").replace(/data%3Aimage/gi, "data:image").replace(/blob%3A/gi, "blob:").replace(/webkit-fake-url%3A/gi, "webkit-fake-url:").replace(/%3F/g, "?").replace(/%3D/g, "=").replace(/%26/g, "&").replace(/&amp;/g, "&").replace(/%2C/g, ",").replace(/%3B/g, ";").replace(/%2B/g, "+").replace(/%40/g, "@").replace(/%5B/g, "[").replace(/%5D/g, "]").replace(/%7B/g, "{").replace(/%7D/g, "}") } return b }

        function q(a) { return a && !a.propertyIsEnumerable("length") && "object" == typeof a && "number" == typeof a.length }

        function r(a) {
            function b(a) { return ("0" + parseInt(a, 10).toString(16)).slice(-2) } try { return a && "transparent" !== a ? /^#[0-9A-F]{6}$/i.test(a) ? a : (a = a.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/), ("#" + b(a[1]) + b(a[2]) + b(a[3])).toUpperCase()) : "" } catch (c) { return null } }

        function s(a) { var b = /^#?([a-f\d])([a-f\d])([a-f\d])$/i;
            a = a.replace(b, function(a, b, c, d) { return b + b + c + c + d + d }); var c = /^#?([a-f\d]{2})([a-f\d]{2})([a-f\d]{2})$/i.exec(a); return c ? "rgb(" + parseInt(c[1], 16) + ", " + parseInt(c[2], 16) + ", " + parseInt(c[3], 16) + ")" : "" }

        function t(c) { var d = (c.css("text-align") || "").replace(/-(.*)-/g, ""); if (["left", "right", "justify", "center"].indexOf(d) < 0) { if (!B) { var e = a('<div dir="' + ("rtl" == b.opts.direction ? "rtl" : "auto") + '" style="text-align: ' + b.$el.css("text-align") + '; position: fixed; left: -3000px;"><span id="s1">.</span><span id="s2">.</span></div>');
                    a("body:first").append(e); var f = e.find("#s1").get(0).getBoundingClientRect().left,
                        g = e.find("#s2").get(0).getBoundingClientRect().left;
                    e.remove(), B = f < g ? "left" : "right" } d = B } return d }

        function u() { return null == C && (C = navigator.platform.toUpperCase().indexOf("MAC") >= 0), C }

        function v() {
            function a(a, b) { var d = a[b];
                a[b] = function(a) { var b, f = !1,
                        g = !1; if (a && a.match(e)) { a = a.replace(e, ""), this.parentNode || (c.appendChild(this), g = !0); var h = this.parentNode; return this.id || (this.id = "rootedQuerySelector_id_" + (new Date).getTime(), f = !0), b = d.call(h, "#" + this.id + " " + a), f && (this.id = ""), g && c.removeChild(this), b } return d.call(this, a) } } var c = b.o_doc.createElement("div"); try { c.querySelectorAll(":scope *") } catch (d) { var e = /^\s*:scope/gi;
                a(Element.prototype, "querySelector"), a(Element.prototype, "querySelectorAll"), a(HTMLElement.prototype, "querySelector"), a(HTMLElement.prototype, "querySelectorAll") } }

        function w() { return b.o_win.pageYOffset ? b.o_win.pageYOffset : b.o_doc.documentElement && b.o_doc.documentElement.scrollTop ? b.o_doc.documentElement.scrollTop : b.o_doc.body.scrollTop ? b.o_doc.body.scrollTop : 0 }

        function x() { return b.o_win.pageXOffset ? b.o_win.pageXOffset : b.o_doc.documentElement && b.o_doc.documentElement.scrollLeft ? b.o_doc.documentElement.scrollLeft : b.o_doc.body.scrollLeft ? b.o_doc.body.scrollLeft : 0 }

        function y() { Element.prototype.matches || (Element.prototype.matches = Element.prototype.msMatchesSelector || Element.prototype.webkitMatchesSelector), Element.prototype.closest || (Element.prototype.closest = function(a) { var b = this,
                    c = this; if (!document.documentElement.contains(b)) return null;
                do { if (c.matches(a)) return c;
                    c = c.parentElement } while (null !== c); return null }) }

        function z(a) { var b = a.getBoundingClientRect(); return b.top >= 0 && b.bottom <= (window.innerHeight || document.documentElement.clientHeight) || b.top <= 0 && b.bottom >= (window.innerHeight || document.documentElement.clientHeight) }

        function A() { b.browser = d(), v(), y() } var B, C = null; return { _init: A, isIOS: e, isMac: u, isAndroid: f, isBlackberry: g, isWindowsPhone: h, isMobile: i, isEmail: o, requestAnimationFrame: j, getPX: k, screenSize: l, isTouch: m, sanitizeURL: p, isArray: q, RGBToHex: r, HEXtoRGB: s, isURL: n, getAlignment: t, scrollTop: w, scrollLeft: x, isInViewPort: z } }, a.FE.MODULES.events = function(b) {
        function c(a, b, c) { s(a, b, c) }

        function d() { c(b.$el, "cut copy paste beforepaste", function(a) { v(a.type, [a]) }) }

        function e() { c(b.$el, "click mouseup mousedown touchstart touchend dragenter dragover dragleave dragend drop dragstart", function(a) { v(a.type, [a]) }), r("mousedown", function() { for (var c = 0; c < a.FE.INSTANCES.length; c++) a.FE.INSTANCES[c] != b && a.FE.INSTANCES[c].popups && a.FE.INSTANCES[c].popups.areVisible() && a.FE.INSTANCES[c].$el.find(".fr-marker").remove() }) }

        function f() { c(b.$el, "keydown keypress keyup input", function(a) { v(a.type, [a]) }) }

        function g() { c(b.$win, b._mousedown, function(a) { v("window.mousedown", [a]), n() }), c(b.$win, b._mouseup, function(a) { v("window.mouseup", [a]) }), c(b.$win, "cut copy keydown keyup touchmove touchend", function(a) { v("window." + a.type, [a]) }) }

        function h() { c(b.$doc, "dragend drop", function(a) { v("document." + a.type, [a]) }) }

        function i(c) { var d; if ("undefined" == typeof c && (c = !0), !b.$wp) return !1; if (b.helpers.isIOS() && b.$win.get(0).focus(), !b.core.hasFocus() && c) { var e = b.$win.scrollTop(); if (b.browser.msie && b.$box && b.$box.css("position", "fixed"), b.browser.msie && b.$wp && b.$wp.css("overflow", "visible"), o(), b.$el.focus(), n(), b.browser.msie && b.$box && b.$box.css("position", ""), b.browser.msie && b.$wp && b.$wp.css("overflow", "auto"), e != b.$win.scrollTop() && b.$win.scrollTop(e), d = b.selection.info(b.el), !d.atStart) return !1 } if (!b.core.hasFocus() || b.$el.find(".fr-marker").length > 0) return !1; if (d = b.selection.info(b.el), d.atStart && b.selection.isCollapsed() && null != b.html.defaultTag()) { var f = b.markers.insert(); if (f && !b.node.blockParent(f)) { a(f).remove(); var g = b.$el.find(b.html.blockTagsQuery()).get(0);
                    g && (a(g).prepend(a.FE.MARKERS), b.selection.restore()) } else f && a(f).remove() } }

        function j() { c(b.$el, "focus", function(a) { p() && (i(!1), C === !1 && v(a.type, [a])) }), c(b.$el, "blur", function(a) { p() && C === !0 && (v(a.type, [a]), n()) }), r("focus", function() { C = !0 }), r("blur", function() { C = !1 }) }

        function k() { b.helpers.isMobile() ? (b._mousedown = "touchstart", b._mouseup = "touchend", b._move = "touchmove", b._mousemove = "touchmove") : (b._mousedown = "mousedown", b._mouseup = "mouseup", b._move = "", b._mousemove = "mousemove") }

        function l(c) { var d = a(c.currentTarget); return b.edit.isDisabled() || b.node.hasClass(d.get(0), "fr-disabled") ? (c.preventDefault(), !1) : "mousedown" === c.type && 1 !== c.which || (b.helpers.isMobile() || c.preventDefault(), (b.helpers.isAndroid() || b.helpers.isWindowsPhone()) && 0 === d.parents(".fr-dropdown-menu").length && (c.preventDefault(), c.stopPropagation()), d.addClass("fr-selected"), void b.events.trigger("commands.mousedown", [d])) }

        function m(c, d) { var e = a(c.currentTarget); if (b.edit.isDisabled() || b.node.hasClass(e.get(0), "fr-disabled")) return c.preventDefault(), !1; if ("mouseup" === c.type && 1 !== c.which) return !0; if (!b.node.hasClass(e.get(0), "fr-selected")) return !0; if ("touchmove" != c.type) { if (c.stopPropagation(), c.stopImmediatePropagation(), c.preventDefault(), !b.node.hasClass(e.get(0), "fr-selected")) return b.button.getButtons(".fr-selected", !0).removeClass("fr-selected"), !1; if (b.button.getButtons(".fr-selected", !0).removeClass("fr-selected"), e.data("dragging") || e.attr("disabled")) return e.removeData("dragging"), !1; var f = e.data("timeout");
                f && (clearTimeout(f), e.removeData("timeout")), d.apply(b, [c]) } else e.data("timeout") || e.data("timeout", setTimeout(function() { e.data("dragging", !0) }, 100)) }

        function n() { A = !0 }

        function o() { A = !1 }

        function p() { return A }

        function q(a, c, d) { s(a, b._mousedown, c, function(a) { b.edit.isDisabled() || l(a) }, !0), s(a, b._mouseup + " " + b._move, c, function(a) { b.edit.isDisabled() || m(a, d) }, !0), s(a, "mousedown click mouseup", c, function(a) { b.edit.isDisabled() || a.stopPropagation() }, !0), r("window.mouseup", function() { b.edit.isDisabled() || (a.find(c).removeClass("fr-selected"), n()) }) }

        function r(a, c, d) { var e = a.split(" "); if (e.length > 1) { for (var f = 0; f < e.length; f++) r(e[f], c, d); return !0 } "undefined" == typeof d && (d = !1); var g;
            g = 0 !== a.indexOf("shared.") ? B[a] = B[a] || [] : b.shared._events[a] = b.shared._events[a] || [], d ? g.unshift(c) : g.push(c) }

        function s(a, c, d, e, f) { "function" == typeof d && (f = e, e = d, d = !1); var g = f ? b.shared.$_events : D,
                h = f ? b.sid : b.id;
            d ? a.on(c.split(" ").join(".ed" + h + " ") + ".ed" + h, d, e) : a.on(c.split(" ").join(".ed" + h + " ") + ".ed" + h, e), g.push([a, c.split(" ").join(".ed" + h + " ") + ".ed" + h]) }

        function t(a) { for (var b = 0; b < a.length; b++) a[b][0].off(a[b][1]) }

        function u() { t(D), D = [], 0 === b.shared.count && (t(b.shared.$_events), b.shared.$_events = []) }

        function v(c, d, e) { if (!b.edit.isDisabled() || e) { var f; if (0 !== c.indexOf("shared.")) f = B[c];
                else { if (b.shared.count > 0) return !1;
                    f = b.shared._events[c] } var g; if (f)
                    for (var h = 0; h < f.length; h++)
                        if (g = f[h].apply(b, d), g === !1) return !1; return g = b.$oel.triggerHandler("froalaEditor." + c, a.merge([b], d || [])), g !== !1 && g } }

        function w(c, d, e) { if (!b.edit.isDisabled() || e) { var f; if (0 !== c.indexOf("shared.")) f = B[c];
                else { if (b.shared.count > 0) return !1;
                    f = b.shared._events[c] } var g; if (f)
                    for (var h = 0; h < f.length; h++) g = f[h].apply(b, [d]), "undefined" != typeof g && (d = g); return g = b.$oel.triggerHandler("froalaEditor." + c, a.merge([b], [d])), "undefined" != typeof g && (d = g), d } }

        function x() { for (var a in B) B.hasOwnProperty(a) && delete B[a] }

        function y() { for (var a in b.shared._events) b.shared._events.hasOwnProperty(a) && delete b.shared._events[a] }

        function z() { b.shared.$_events = b.shared.$_events || [], b.shared._events = {}, k(), e(), g(), h(), f(), j(), n(), d(), r("destroy", x), r("shared.destroy", y) } var A, B = {},
            C = !1,
            D = []; return { _init: z, on: r, trigger: v, bindClick: q, disableBlur: o, enableBlur: n, blurActive: p, focus: i, chainTrigger: w, $on: s, $off: u } }, a.FE.MODULES.node = function(b) {
        function c(a) { return a && "IFRAME" != a.tagName ? Array.prototype.slice.call(a.childNodes || []) : [] }

        function d(b) { return !!b && (b.nodeType == Node.ELEMENT_NODE && a.FE.BLOCK_TAGS.indexOf(b.tagName.toLowerCase()) >= 0) }

        function e(a) { return !!a && (a.nodeType == Node.ELEMENT_NODE && "a" == a.tagName.toLowerCase()) }

        function f(e, f) { if (!e) return !0; if (e.querySelector("table")) return !1; var g = c(e);
            1 == g.length && d(g[0]) && (g = c(g[0])); for (var h = !1, i = 0; i < g.length; i++) { var j = g[i]; if (!(f && b.node.hasClass(j, "fr-marker") || j.nodeType == Node.TEXT_NODE && 0 === j.textContent.length)) { if ("BR" != j.tagName && (j.textContent || "").replace(/\u200B/gi, "").replace(/\n/g, "").length > 0) return !1; if (h) return !1; "BR" == j.tagName && (h = !0) } } return !(e.querySelectorAll(a.FE.VOID_ELEMENTS.join(",")).length - e.querySelectorAll("br").length) && (!e.querySelector(b.opts.htmlAllowedEmptyTags.join(":not(.fr-marker),") + ":not(.fr-marker)") && (!(e.querySelectorAll(a.FE.BLOCK_TAGS.join(",")).length > 1) && !e.querySelector(b.opts.htmlDoNotWrapTags.join(":not(.fr-marker),") + ":not(.fr-marker)"))) }

        function g(a) { for (; a && a.parentNode !== b.el && (!a.parentNode || !b.node.hasClass(a.parentNode, "fr-inner"));)
                if (a = a.parentNode, d(a)) return a; return null }

        function h(c, e, f) { if ("undefined" == typeof e && (e = []), "undefined" == typeof f && (f = !0), e.push(b.el), e.indexOf(c.parentNode) >= 0 || c.parentNode && b.node.hasClass(c.parentNode, "fr-inner") || c.parentNode && a.FE.SIMPLE_ENTER_TAGS.indexOf(c.parentNode.tagName) >= 0 && f) return null; for (; e.indexOf(c.parentNode) < 0 && c.parentNode && !b.node.hasClass(c.parentNode, "fr-inner") && (a.FE.SIMPLE_ENTER_TAGS.indexOf(c.parentNode.tagName) < 0 || !f) && (!d(c) || !d(c.parentNode) || !f);) c = c.parentNode; return c }

        function i(a) { var b = {},
                c = a.attributes; if (c)
                for (var d = 0; d < c.length; d++) { var e = c[d];
                    b[e.nodeName] = e.value }
            return b }

        function j(a) { for (var b = "", c = i(a), d = Object.keys(c).sort(), e = 0; e < d.length; e++) { var f = d[e],
                    g = c[f];
                g.indexOf("'") < 0 && g.indexOf('"') >= 0 ? b += " " + f + "='" + g + "'" : g.indexOf('"') >= 0 && g.indexOf("'") >= 0 ? (g = g.replace(/"/g, "&quot;"), b += " " + f + '="' + g + '"') : b += " " + f + '="' + g + '"' } return b }

        function k(a) { for (var b = a.attributes, c = b.length - 1; c >= 0; c--) { var d = b[c];
                a.removeAttribute(d.nodeName) } }

        function l(a) { return "<" + a.tagName.toLowerCase() + j(a) + ">" }

        function m(a) { return "</" + a.tagName.toLowerCase() + ">" }

        function n(a, c) { "undefined" == typeof c && (c = !0); for (var d = a.previousSibling; d && c && b.node.hasClass(d, "fr-marker");) d = d.previousSibling; return !d || d.nodeType == Node.TEXT_NODE && "" === d.textContent && n(d) }

        function o(a, c) { "undefined" == typeof c && (c = !0); for (var d = a.nextSibling; d && c && b.node.hasClass(d, "fr-marker");) d = d.nextSibling; return !d || d.nodeType == Node.TEXT_NODE && "" === d.textContent && o(d) }

        function p(b) { return b && b.nodeType == Node.ELEMENT_NODE && a.FE.VOID_ELEMENTS.indexOf((b.tagName || "").toLowerCase()) >= 0 }

        function q(a) { return !!a && ["UL", "OL"].indexOf(a.tagName) >= 0 }

        function r(a) { return a === b.el }

        function s(a) { return a && a.nodeType == Node.ELEMENT_NODE && a.getAttribute("class") && (a.getAttribute("class") || "").indexOf("fr-deletable") >= 0 }

        function t(a) { return a === b.doc.activeElement && (!b.doc.hasFocus || b.doc.hasFocus()) && !!(r(a) || a.type || a.href || ~a.tabIndex) }

        function u(a) { return (!a.getAttribute || "false" != a.getAttribute("contenteditable")) && ["STYLE", "SCRIPT"].indexOf(a.tagName) < 0 }

        function v(b, c) { return b instanceof a && (b = b.get(0)), b && b.classList && b.classList.contains(c) }

        function w(a) { return b.browser.msie ? a : { acceptNode: a } } return { isBlock: d, isEmpty: f, blockParent: g, deepestParent: h, rawAttributes: i, attributes: j, clearAttributes: k, openTagString: l, closeTagString: m, isFirstSibling: n, isLastSibling: o, isList: q, isLink: e, isElement: r, contents: c, isVoid: p, hasFocus: t, isEditable: u, isDeletable: s, hasClass: v, filter: w } }, a.FE.INVISIBLE_SPACE = "&#8203;", a.FE.START_MARKER = '<span class="fr-marker" data-id="0" data-type="true" style="display: none; line-height: 0;">' + a.FE.INVISIBLE_SPACE + "</span>", a.FE.END_MARKER = '<span class="fr-marker" data-id="0" data-type="false" style="display: none; line-height: 0;">' + a.FE.INVISIBLE_SPACE + "</span>", a.FE.MARKERS = a.FE.START_MARKER + a.FE.END_MARKER, a.FE.MODULES.markers = function(b) {
        function c(c, d) { return a('<span class="fr-marker" data-id="' + d + '" data-type="' + c + '" style="display: ' + (b.browser.safari ? "none" : "inline-block") + '; line-height: 0;">' + a.FE.INVISIBLE_SPACE + "</span>", b.doc)[0] }

        function d(d, e, f) { var g, h, i; try { var j = d.cloneRange(); if (j.collapse(e), j.insertNode(c(e, f)), e === !0)
                    for (g = b.$el.find('span.fr-marker[data-type="true"][data-id="' + f + '"]').get(0), i = g.nextSibling; i && i.nodeType === Node.TEXT_NODE && 0 === i.textContent.length;) a(i).remove(), i = g.nextSibling; if (e === !0 && !d.collapsed) { for (; !b.node.isElement(g.parentNode) && !i;) a(g.parentNode).after(g), i = g.nextSibling; if (i && i.nodeType === Node.ELEMENT_NODE && b.node.isBlock(i)) { h = [i];
                        do i = h[0], h = b.node.contents(i); while (h[0] && b.node.isBlock(h[0]));
                        a(i).prepend(a(g)) } } if (e === !1 && !d.collapsed) { if (g = b.$el.find('span.fr-marker[data-type="false"][data-id="' + f + '"]').get(0), i = g.previousSibling, i && i.nodeType === Node.ELEMENT_NODE && b.node.isBlock(i)) { h = [i];
                        do i = h[h.length - 1], h = b.node.contents(i); while (h[h.length - 1] && b.node.isBlock(h[h.length - 1]));
                        a(i).append(a(g)) } g.parentNode && ["TD", "TH"].indexOf(g.parentNode.tagName) >= 0 && g.parentNode.previousSibling && !g.previousSibling && a(g.parentNode.previousSibling).append(g) } var k = b.$el.find('span.fr-marker[data-type="' + e + '"][data-id="' + f + '"]').get(0); return k && (k.style.display = "none"), k } catch (l) { return null } }

        function e() { if (!b.$wp) return null; try { var c = b.selection.ranges(0),
                    d = c.commonAncestorContainer; if (d != b.el && 0 === b.$el.find(d).length) return null; var e = c.cloneRange(),
                    f = c.cloneRange();
                e.collapse(!0); var g = a('<span class="fr-marker" style="display: none; line-height: 0;">' + a.FE.INVISIBLE_SPACE + "</span>", b.doc)[0]; if (e.insertNode(g), g = b.$el.find("span.fr-marker").get(0)) { for (var h = g.nextSibling; h && h.nodeType === Node.TEXT_NODE && 0 === h.textContent.length;) a(h).remove(), h = b.$el.find("span.fr-marker").get(0).nextSibling; return b.selection.clear(), b.selection.get().addRange(f), g } return null } catch (i) { console.warn("MARKER", i) } }

        function f() { b.selection.isCollapsed() || b.selection.remove(); var c = b.$el.find(".fr-marker").get(0); if (null == c && (c = e()), null == c) return null; var d = b.node.deepestParent(c); if (d || (d = b.node.blockParent(c), d && "LI" != d.tagName && (d = null)), d)
                if (b.node.isBlock(d) && b.node.isEmpty(d)) "LI" != d.tagName || d.parentNode.firstElementChild != d || b.node.isEmpty(d.parentNode) ? a(d).replaceWith('<span class="fr-marker"></span>') : a(d).append('<span class="fr-marker"></span>');
                else if (b.cursor.isAtStart(c, d)) a(d).before('<span class="fr-marker"></span>'), a(c).remove();
            else if (b.cursor.isAtEnd(c, d)) a(d).after('<span class="fr-marker"></span>'), a(c).remove();
            else { var f = c,
                    g = "",
                    h = "";
                do f = f.parentNode, g += b.node.closeTagString(f), h = b.node.openTagString(f) + h; while (f != d);
                a(c).replaceWith('<span id="fr-break"></span>'); var i = b.node.openTagString(d) + a(d).html() + b.node.closeTagString(d);
                i = i.replace(/<span id="fr-break"><\/span>/g, g + '<span class="fr-marker"></span>' + h), a(d).replaceWith(i) } return b.$el.find(".fr-marker").get(0) }

        function g(a) { var c = a.clientX,
                d = a.clientY;
            h(); var f, g = null; if ("undefined" != typeof b.doc.caretPositionFromPoint ? (f = b.doc.caretPositionFromPoint(c, d), g = b.doc.createRange(), g.setStart(f.offsetNode, f.offset), g.setEnd(f.offsetNode, f.offset)) : "undefined" != typeof b.doc.caretRangeFromPoint && (f = b.doc.caretRangeFromPoint(c, d), g = b.doc.createRange(), g.setStart(f.startContainer, f.startOffset), g.setEnd(f.startContainer, f.startOffset)), null !== g && "undefined" != typeof b.win.getSelection) { var i = b.win.getSelection();
                i.removeAllRanges(), i.addRange(g) } else if ("undefined" != typeof b.doc.body.createTextRange) try { g = b.doc.body.createTextRange(), g.moveToPoint(c, d); var j = g.duplicate();
                j.moveToPoint(c, d), g.setEndPoint("EndToEnd", j), g.select() } catch (k) { return !1 } e() }

        function h() { b.$el.find(".fr-marker").remove() } return { place: d, insert: e, split: f, insertAtPoint: g, remove: h } }, a.FE.MODULES.selection = function(b) {
        function c() { var a = ""; return b.win.getSelection ? a = b.win.getSelection() : b.doc.getSelection ? a = b.doc.getSelection() : b.doc.selection && (a = b.doc.selection.createRange().text), a.toString() }

        function d() { var a = ""; return a = b.win.getSelection ? b.win.getSelection() : b.doc.getSelection ? b.doc.getSelection() : b.doc.selection.createRange() }

        function e(a) { var c = d(),
                e = []; if (c && c.getRangeAt && c.rangeCount) { e = []; for (var f = 0; f < c.rangeCount; f++) e.push(c.getRangeAt(f)) } else e = b.doc.createRange ? [b.doc.createRange()] : []; return "undefined" != typeof a ? e[a] : e }

        function f() { var a = d(); try { a.removeAllRanges ? a.removeAllRanges() : a.empty ? a.empty() : a.clear && a.clear() } catch (b) {} }

        function g() { var f = d(); try { if (f.rangeCount) { var g, h = e(0),
                        i = h.startContainer; if (i.nodeType == Node.TEXT_NODE && h.startOffset == (i.textContent || "").length && i.nextSibling && (i = i.nextSibling), i.nodeType == Node.ELEMENT_NODE) { var j = !1; if (i.childNodes.length > 0 && i.childNodes[h.startOffset]) { for (g = i.childNodes[h.startOffset]; g && g.nodeType == Node.TEXT_NODE && 0 === g.textContent.length;) g = g.nextSibling; if (g && g.textContent.replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && (i = g, j = !0), !j && i.childNodes.length > 1 && h.startOffset > 0 && i.childNodes[h.startOffset - 1]) { for (g = i.childNodes[h.startOffset - 1]; g && g.nodeType == Node.TEXT_NODE && 0 === g.textContent.length;) g = g.nextSibling;
                                g && g.textContent.replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && (i = g, j = !0) } } else !h.collapsed && i.nextSibling && i.nextSibling.nodeType == Node.ELEMENT_NODE && (g = i.nextSibling, g && g.textContent.replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && (i = g, j = !0));!j && i.childNodes.length > 0 && a(i.childNodes[0]).text().replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && ["BR", "IMG", "HR"].indexOf(i.childNodes[0].tagName) < 0 && (i = i.childNodes[0]) } for (; i.nodeType != Node.ELEMENT_NODE && i.parentNode;) i = i.parentNode; for (var k = i; k && "HTML" != k.tagName;) { if (k == b.el) return i;
                        k = a(k).parent()[0] } } } catch (l) {} return b.el }

        function h() { var f = d(); try { if (f.rangeCount) { var g, h = e(0),
                        i = h.endContainer; if (i.nodeType == Node.ELEMENT_NODE) { var j = !1;
                        i.childNodes.length > 0 && i.childNodes[h.endOffset] && a(i.childNodes[h.endOffset]).text() === c() ? (i = i.childNodes[h.endOffset], j = !0) : !h.collapsed && i.previousSibling && i.previousSibling.nodeType == Node.ELEMENT_NODE ? (g = i.previousSibling, g && g.textContent.replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && (i = g, j = !0)) : !h.collapsed && i.childNodes.length > 0 && i.childNodes[h.endOffset] && (g = i.childNodes[h.endOffset].previousSibling, g.nodeType == Node.ELEMENT_NODE && g && g.textContent.replace(/\u200B/g, "") === c().replace(/\u200B/g, "") && (i = g, j = !0)), !j && i.childNodes.length > 0 && a(i.childNodes[i.childNodes.length - 1]).text() === c() && ["BR", "IMG", "HR"].indexOf(i.childNodes[i.childNodes.length - 1].tagName) < 0 && (i = i.childNodes[i.childNodes.length - 1]) } for (i.nodeType == Node.TEXT_NODE && 0 === h.endOffset && i.previousSibling && i.previousSibling.nodeType == Node.ELEMENT_NODE && (i = i.previousSibling); i.nodeType != Node.ELEMENT_NODE && i.parentNode;) i = i.parentNode; for (var k = i; k && "HTML" != k.tagName;) { if (k == b.el) return i;
                        k = a(k).parent()[0] } } } catch (l) {} return b.el }

        function i(a, b) { var c = a; return c.nodeType == Node.ELEMENT_NODE && c.childNodes.length > 0 && c.childNodes[b] && (c = c.childNodes[b]), c.nodeType == Node.TEXT_NODE && (c = c.parentNode), c }

        function j() { var c, f = [],
                g = d(); if (u() && g.rangeCount) { var h = e(); for (c = 0; c < h.length; c++) { var j, k = h[c],
                        l = i(k.startContainer, k.startOffset),
                        m = i(k.endContainer, k.endOffset);
                    b.node.isBlock(l) && f.indexOf(l) < 0 && f.push(l), j = b.node.blockParent(l), j && f.indexOf(j) < 0 && f.push(j); for (var n = [], o = l; o !== m && o !== b.el;) n.indexOf(o) < 0 && o.children && o.children.length ? (n.push(o), o = o.children[0]) : o.nextSibling ? o = o.nextSibling : o.parentNode && (o = o.parentNode, n.push(o)), b.node.isBlock(o) && n.indexOf(o) < 0 && f.indexOf(o) < 0 && (o !== m || k.endOffset > 0) && f.push(o);
                    b.node.isBlock(m) && f.indexOf(m) < 0 && k.endOffset > 0 && f.push(m), j = b.node.blockParent(m), j && f.indexOf(j) < 0 && f.push(j) } } for (c = f.length - 1; c > 0; c--) a(f[c]).find(f).length && ("LI" != f[c].tagName || f[c].children.length > 0 && f.indexOf(f[c].children[0]) >= 0) && f.splice(c, 1); return f }

        function k() { if (b.$wp) { b.markers.remove(); var c, d, f = e(),
                    g = []; for (d = 0; d < f.length; d++)
                    if (f[d].startContainer !== b.doc || b.browser.msie) { c = f[d]; var h = c.collapsed,
                            i = b.markers.place(c, !0, d),
                            j = b.markers.place(c, !1, d); "undefined" != typeof i && i || !h || (a(".fr-marker").remove(), b.selection.setAtEnd(b.el)), b.el.normalize(), b.browser.safari && !h && (c = b.doc.createRange(), c.setStartAfter(i), c.setEndBefore(j), g.push(c)) }
                if (b.browser.safari && g.length)
                    for (b.selection.clear(), d = 0; d < g.length; d++) b.selection.get().addRange(g[d]) } }

        function l() {
            var c, e = b.el.querySelectorAll('.fr-marker[data-type="true"]');
            if (!b.$wp) return b.markers.remove(), !1;
            if (0 === e.length) return !1;
            if (b.browser.msie || b.browser.edge)
                for (c = 0; c < e.length; c++) e[c].style.display = "inline-block";
            b.core.hasFocus() || b.browser.msie || b.browser.webkit || b.$el.focus(), f();
            var g = d();
            for (c = 0; c < e.length; c++) {
                var h = a(e[c]).data("id"),
                    i = e[c],
                    j = b.doc.createRange(),
                    k = b.$el.find('.fr-marker[data-type="false"][data-id="' + h + '"]');
                (b.browser.msie || b.browser.edge) && k.css("display", "inline-block");
                var l = null;
                if (k.length > 0) {
                    k = k[0];
                    try {
                        for (var n, o = !1, p = i.nextSibling; p && p.nodeType == Node.TEXT_NODE && 0 === p.textContent.length;) n = p, p = p.nextSibling, a(n).remove();
                        for (var q = k.nextSibling; q && q.nodeType == Node.TEXT_NODE && 0 === q.textContent.length;) n = q, q = q.nextSibling, a(n).remove();
                        if (i.nextSibling == k || k.nextSibling == i) {
                            for (var r = i.nextSibling == k ? i : k, s = r == i ? k : i, t = r.previousSibling; t && t.nodeType == Node.TEXT_NODE && 0 === t.length;) n = t, t = t.previousSibling, a(n).remove();
                            if (t && t.nodeType == Node.TEXT_NODE)
                                for (; t && t.previousSibling && t.previousSibling.nodeType == Node.TEXT_NODE;) t.previousSibling.textContent = t.previousSibling.textContent + t.textContent, t = t.previousSibling, a(t.nextSibling).remove();
                            for (var u = s.nextSibling; u && u.nodeType == Node.TEXT_NODE && 0 === u.length;) n = u,
                                u = u.nextSibling, a(n).remove();
                            if (u && u.nodeType == Node.TEXT_NODE)
                                for (; u && u.nextSibling && u.nextSibling.nodeType == Node.TEXT_NODE;) u.nextSibling.textContent = u.textContent + u.nextSibling.textContent, u = u.nextSibling, a(u.previousSibling).remove();
                            if (t && (b.node.isVoid(t) || b.node.isBlock(t)) && (t = null), u && (b.node.isVoid(u) || b.node.isBlock(u)) && (u = null), t && u && t.nodeType == Node.TEXT_NODE && u.nodeType == Node.TEXT_NODE) { a(i).remove(), a(k).remove(); var v = t.textContent.length;
                                t.textContent = t.textContent + u.textContent, a(u).remove(), b.spaces.normalize(t), j.setStart(t, v), j.setEnd(t, v), o = !0 } else !t && u && u.nodeType == Node.TEXT_NODE ? (a(i).remove(), a(k).remove(), b.spaces.normalize(u), l = a(b.doc.createTextNode("\u200b")), a(u).before(l), j.setStart(u, 0), j.setEnd(u, 0), o = !0) : !u && t && t.nodeType == Node.TEXT_NODE && (a(i).remove(), a(k).remove(), b.spaces.normalize(t), l = a(b.doc.createTextNode("\u200b")), a(t).after(l), j.setStart(t, t.textContent.length), j.setEnd(t, t.textContent.length), o = !0)
                        }
                        if (!o) { var w, x;
                            (b.browser.chrome || b.browser.edge) && i.nextSibling == k ? (w = m(k, j, !0) || j.setStartAfter(k), x = m(i, j, !1) || j.setEndBefore(i)) : (i.previousSibling == k && (i = k, k = i.nextSibling), k.nextSibling && "BR" === k.nextSibling.tagName || !k.nextSibling && b.node.isBlock(i.previousSibling) || i.previousSibling && "BR" == i.previousSibling.tagName || (i.style.display = "inline", k.style.display = "inline", l = a(b.doc.createTextNode("\u200b"))), w = m(i, j, !0) || a(i).before(l) && j.setStartBefore(i), x = m(k, j, !1) || a(k).after(l) && j.setEndAfter(k)), "function" == typeof w && w(), "function" == typeof x && x() }
                    } catch (y) { console.warn("RESTORE RANGE", y) }
                }
                l && l.remove();
                try { g.addRange(j) } catch (y) { console.warn("ADD RANGE", y) }
            }
            b.markers.remove()
        }

        function m(c, d, e) { var f, g = c.previousSibling,
                h = c.nextSibling; return g && h && g.nodeType == Node.TEXT_NODE && h.nodeType == Node.TEXT_NODE ? (f = g.textContent.length, e ? (h.textContent = g.textContent + h.textContent, a(g).remove(), a(c).remove(), b.spaces.normalize(h), function() { d.setStart(h, f) }) : (g.textContent = g.textContent + h.textContent, a(h).remove(), a(c).remove(), b.spaces.normalize(g), function() { d.setEnd(g, f) })) : g && !h && g.nodeType == Node.TEXT_NODE ? (f = g.textContent.length, e ? (b.spaces.normalize(g), function() { d.setStart(g, f) }) : (b.spaces.normalize(g), function() { d.setEnd(g, f) })) : !(!h || g || h.nodeType != Node.TEXT_NODE) && (e ? (b.spaces.normalize(h), function() { d.setStart(h, 0) }) : (b.spaces.normalize(h), function() { d.setEnd(h, 0) })) }

        function n() { return !0 }

        function o() { for (var a = e(), b = 0; b < a.length; b++)
                if (!a[b].collapsed) return !1; return !0 }

        function p(a) { var c, d, e = !1,
                f = !1; if (b.win.getSelection) { var g = b.win.getSelection();
                g.rangeCount && (c = g.getRangeAt(0), d = c.cloneRange(), d.selectNodeContents(a), d.setEnd(c.startContainer, c.startOffset), e = "" === d.toString(), d.selectNodeContents(a), d.setStart(c.endContainer, c.endOffset), f = "" === d.toString()) } else b.doc.selection && "Control" != b.doc.selection.type && (c = b.doc.selection.createRange(), d = c.duplicate(), d.moveToElementText(a), d.setEndPoint("EndToStart", c), e = "" === d.text, d.moveToElementText(a), d.setEndPoint("StartToEnd", c), f = "" === d.text); return { atStart: e, atEnd: f } }

        function q() { if (o()) return !1;
            b.$el.find("td, th, img, br:not(:last)").prepend('<span class="fr-mk">' + a.FE.INVISIBLE_SPACE + "</span>"); var c = !1,
                d = p(b.el); return d.atStart && d.atEnd && (c = !0), b.$el.find(".fr-mk").remove(), c }

        function r(c, d) { "undefined" == typeof d && (d = !0); var e = a(c).html();
            e && e.replace(/\u200b/g, "").length != e.length && a(c).html(e.replace(/\u200b/g, "")); for (var f = b.node.contents(c), g = 0; g < f.length; g++) f[g].nodeType != Node.ELEMENT_NODE ? a(f[g]).remove() : (r(f[g], 0 === g), 0 === g && (d = !1));
            c.nodeType == Node.TEXT_NODE ? a(c).replaceWith('<span data-first="true" data-text="true"></span>') : d && a(c).attr("data-first", !0) }

        function s() { return 0 === a(this).find("fr-inner").length }

        function t(c, d) { var e = b.node.contents(c.get(0));
            ["TD", "TH"].indexOf(c.get(0).tagName) >= 0 && 1 == c.find(".fr-marker").length && b.node.hasClass(e[0], "fr-marker") && c.attr("data-del-cell", !0); for (var f = 0; f < e.length; f++) { var g = e[f];
                b.node.hasClass(g, "fr-marker") ? d = (d + 1) % 2 : d ? a(g).find(".fr-marker").length > 0 ? d = t(a(g), d) : ["TD", "TH"].indexOf(g.tagName) < 0 && !b.node.hasClass(g, "fr-inner") ? !b.opts.keepFormatOnDelete || b.$el.find("[data-first]").length > 0 ? a(g).remove() : r(g) : b.node.hasClass(g, "fr-inner") ? 0 === a(g).find(".fr-inner").length ? a(g).html("<br>") : a(g).find(".fr-inner").filter(s).html("<br>") : (a(g).empty(), a(g).attr("data-del-cell", !0)) : a(g).find(".fr-marker").length > 0 && (d = t(a(g), d)) } return d }

        function u() { try { if (!b.$wp) return !1; for (var a = e(0), c = a.commonAncestorContainer; c && !b.node.isElement(c);) c = c.parentNode; return !!b.node.isElement(c) } catch (d) { return !1 } }

        function v() { if (o()) return !0; var c;
            k(); var d = function(b) { for (var c = b.previousSibling; c && c.nodeType == Node.TEXT_NODE && 0 === c.textContent.length;) { var d = c;
                        c = c.previousSibling, a(d).remove() } return c },
                e = function(b) { for (var c = b.nextSibling; c && c.nodeType == Node.TEXT_NODE && 0 === c.textContent.length;) { var d = c;
                        c = c.nextSibling, a(d).remove() } return c },
                f = b.$el.find('.fr-marker[data-type="true"]'); for (c = 0; c < f.length; c++)
                for (var g = f[c]; !(d(g) || b.node.isBlock(g.parentNode) || b.$el.is(g.parentNode) || b.node.hasClass(g.parentNode, "fr-inner"));) a(g.parentNode).before(g); var h = b.$el.find('.fr-marker[data-type="false"]'); for (c = 0; c < h.length; c++) { for (var i = h[c]; !(e(i) || b.node.isBlock(i.parentNode) || b.$el.is(i.parentNode) || b.node.hasClass(i.parentNode, "fr-inner"));) a(i.parentNode).after(i);
                i.parentNode && b.node.isBlock(i.parentNode) && b.node.isEmpty(i.parentNode) && !b.$el.is(i.parentNode) && !b.node.hasClass(i.parentNode, "fr-inner") && b.opts.keepFormatOnDelete && a(i.parentNode).after(i) } if (n()) { t(b.$el, 0); var j = b.$el.find('[data-first="true"]'); if (j.length) b.$el.find(".fr-marker").remove(), j.append(a.FE.INVISIBLE_SPACE + a.FE.MARKERS).removeAttr("data-first"), j.attr("data-text") && j.replaceWith(j.html());
                else
                    for (b.$el.find("table").filter(function() { var b = a(this).find("[data-del-cell]").length > 0 && a(this).find("[data-del-cell]").length == a(this).find("td, th").length; return b }).remove(), b.$el.find("[data-del-cell]").removeAttr("data-del-cell"), f = b.$el.find('.fr-marker[data-type="true"]'), c = 0; c < f.length; c++) { var m = f[c],
                            p = m.nextSibling,
                            q = b.$el.find('.fr-marker[data-type="false"][data-id="' + a(m).data("id") + '"]').get(0); if (q) { if (m && (!p || p != q)) { var r = b.node.blockParent(m),
                                    s = b.node.blockParent(q),
                                    u = !1,
                                    v = !1; if (r && ["UL", "OL"].indexOf(r.tagName) >= 0 && (r = null, u = !0), s && ["UL", "OL"].indexOf(s.tagName) >= 0 && (s = null, v = !0), a(m).after(q), r != s)
                                    if (null != r || u)
                                        if (null != s || v || 0 !== a(r).parentsUntil(b.$el, "table").length) r && s && 0 === a(r).parentsUntil(b.$el, "table").length && 0 === a(s).parentsUntil(b.$el, "table").length && 0 === a(r).find(s).length && 0 === a(s).find(r).length && (a(r).append(a(s).html()), a(s).remove());
                                        else { for (p = r; !p.nextSibling && p.parentNode != b.el;) p = p.parentNode; for (p = p.nextSibling; p && "BR" != p.tagName;) { var w = p.nextSibling;
                                                a(r).append(p), p = w } p && "BR" == p.tagName && a(p).remove() } else { var x = b.node.deepestParent(m);
                                    x ? (a(x).after(a(s).html()), a(s).remove()) : 0 === a(s).parentsUntil(b.$el, "table").length && (a(m).next().after(a(s).html()), a(s).remove()) } } } else q = a(m).clone().attr("data-type", !1), a(m).after(q) } } b.opts.keepFormatOnDelete || b.html.fillEmptyBlocks(), b.html.cleanEmptyTags(!0), b.clean.lists(), b.opts.htmlUntouched || b.spaces.normalize(); var y = b.$el.find(".fr-marker:last").get(0),
                z = b.$el.find(".fr-marker:first").get(0); "undefined" != typeof y && "undefined" != typeof z && !y.nextSibling && z.previousSibling && "BR" == z.previousSibling.tagName && b.node.isElement(y.parentNode) && b.node.isElement(z.parentNode) && b.$el.append("<br>"), l() }

        function w(c, d) { if (!c || c.getElementsByClassName("fr-marker").length > 0) return !1; for (var e = c.firstChild; e && (b.node.isBlock(e) || d && !b.node.isVoid(e) && e.nodeType == Node.ELEMENT_NODE);) c = e, e = e.firstChild;
            c.innerHTML = a.FE.MARKERS + c.innerHTML }

        function x(c, d) { if (!c || c.getElementsByClassName("fr-marker").length > 0) return !1; for (var e = c.lastChild; e && (b.node.isBlock(e) || d && !b.node.isVoid(e) && e.nodeType == Node.ELEMENT_NODE);) c = e, e = e.lastChild; var f = b.doc.createElement("SPAN");
            f.setAttribute("id", "fr-sel-markers"), f.innerHTML = a.FE.MARKERS, c.appendChild(f); var g = c.querySelector("#fr-sel-markers");
            g.outerHTML = g.innerHTML }

        function y(c, d) { "undefined" == typeof d && (d = !0); for (var e = c.previousSibling; e && e.nodeType == Node.TEXT_NODE && 0 === e.textContent.length;) e = e.previousSibling; return e ? (b.node.isBlock(e) ? x(e) : "BR" == e.tagName ? a(e).before(a.FE.MARKERS) : a(e).after(a.FE.MARKERS), !0) : !!d && (b.node.isBlock(c) ? w(c) : a(c).before(a.FE.MARKERS), !0) }

        function z(c, d) { "undefined" == typeof d && (d = !0); for (var e = c.nextSibling; e && e.nodeType == Node.TEXT_NODE && 0 === e.textContent.length;) e = e.nextSibling; return e ? (b.node.isBlock(e) ? w(e) : a(e).before(a.FE.MARKERS), !0) : !!d && (b.node.isBlock(c) ? x(c) : a(c).after(a.FE.MARKERS), !0) }
        return { text: c, get: d, ranges: e, clear: f, element: g, endElement: h, save: k, restore: l, isCollapsed: o, isFull: q, inEditor: u, remove: v, blocks: j, info: p, setAtEnd: x, setAtStart: w, setBefore: y, setAfter: z, rangeElement: i }
    }, a.extend(a.FE.DEFAULTS, { htmlAllowedTags: ["a", "abbr", "address", "area", "article", "aside", "audio", "b", "base", "bdi", "bdo", "blockquote", "br", "button", "canvas", "caption", "cite", "code", "col", "colgroup", "datalist", "dd", "del", "details", "dfn", "dialog", "div", "dl", "dt", "em", "embed", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "hr", "i", "iframe", "img", "input", "ins", "kbd", "keygen", "label", "legend", "li", "link", "main", "map", "mark", "menu", "menuitem", "meter", "nav", "noscript", "object", "ol", "optgroup", "option", "output", "p", "param", "pre", "progress", "queue", "rp", "rt", "ruby", "s", "samp", "script", "style", "section", "select", "small", "source", "span", "strike", "strong", "sub", "summary", "sup", "table", "tbody", "td", "textarea", "tfoot", "th", "thead", "time", "tr", "track", "u", "ul", "var", "video", "wbr"], htmlRemoveTags: ["script", "style"], htmlAllowedAttrs: ["accept", "accept-charset", "accesskey", "action", "align", "allowfullscreen", "allowtransparency", "alt", "async", "autocomplete", "autofocus", "autoplay", "autosave", "background", "bgcolor", "border", "charset", "cellpadding", "cellspacing", "checked", "cite", "class", "color", "cols", "colspan", "content", "contenteditable", "contextmenu", "controls", "coords", "data", "data-.*", "datetime", "default", "defer", "dir", "dirname", "disabled", "download", "draggable", "dropzone", "enctype", "for", "form", "formaction", "frameborder", "headers", "height", "hidden", "high", "href", "hreflang", "http-equiv", "icon", "id", "ismap", "itemprop", "keytype", "kind", "label", "lang", "language", "list", "loop", "low", "max", "maxlength", "media", "method", "min", "mozallowfullscreen", "multiple", "muted", "name", "novalidate", "open", "optimum", "pattern", "ping", "placeholder", "playsinline", "poster", "preload", "pubdate", "radiogroup", "readonly", "rel", "required", "reversed", "rows", "rowspan", "sandbox", "scope", "scoped", "scrolling", "seamless", "selected", "shape", "size", "sizes", "span", "src", "srcdoc", "srclang", "srcset", "start", "step", "summary", "spellcheck", "style", "tabindex", "target", "title", "type", "translate", "usemap", "value", "valign", "webkitallowfullscreen", "width", "wrap"], htmlAllowedStyleProps: [".*"], htmlAllowComments: !0, htmlUntouched: !1, fullPage: !1 }), a.FE.HTML5Map = { B: "STRONG", I: "EM", STRIKE: "S" }, a.FE.MODULES.clean = function(b) {
        function c(a) { if (a.nodeType == Node.ELEMENT_NODE && a.getAttribute("class") && a.getAttribute("class").indexOf("fr-marker") >= 0) return !1; var d, e = b.node.contents(a),
                f = []; for (d = 0; d < e.length; d++) e[d].nodeType != Node.ELEMENT_NODE || b.node.isVoid(e[d]) ? e[d].nodeType == Node.TEXT_NODE && (e[d].textContent = e[d].textContent.replace(/\u200b/g, "")) : e[d].textContent.replace(/\u200b/g, "").length != e[d].textContent.length && c(e[d]); if (a.nodeType == Node.ELEMENT_NODE && !b.node.isVoid(a) && (a.normalize(), e = b.node.contents(a), f = a.querySelectorAll(".fr-marker"), e.length - f.length === 0)) { for (d = 0; d < e.length; d++)
                    if ((e[d].getAttribute("class") || "").indexOf("fr-marker") < 0) return !1; for (d = 0; d < f.length; d++) a.parentNode.insertBefore(f[d].cloneNode(!0), a); return a.parentNode.removeChild(a), !1 } }

        function d(a, c) { if (a.nodeType == Node.COMMENT_NODE) return "<!--" + a.nodeValue + "-->"; if (a.nodeType == Node.TEXT_NODE) return c ? a.textContent.replace(/\&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;") : a.textContent.replace(/\&/g, "&amp;").replace(/</g, "&lt;").replace(/>/g, "&gt;").replace(/\u00A0/g, "&nbsp;").replace(/\u0009/g, ""); if (a.nodeType != Node.ELEMENT_NODE) return a.outerHTML; if (a.nodeType == Node.ELEMENT_NODE && ["STYLE", "SCRIPT", "NOSCRIPT"].indexOf(a.tagName) >= 0) return a.outerHTML; if (a.nodeType == Node.ELEMENT_NODE && "svg" == a.tagName) { var e = document.createElement("div"),
                    f = a.cloneNode(!0); return e.appendChild(f), e.innerHTML } if ("IFRAME" == a.tagName) return a.outerHTML.replace(/\&lt;/g, "<").replace(/\&gt;/g, ">"); var g = a.childNodes; if (0 === g.length) return a.outerHTML; for (var h = "", i = 0; i < g.length; i++) "PRE" == a.tagName && (c = !0), h += d(g[i], c); return b.node.openTagString(a) + h + b.node.closeTagString(a) }

        function e(a) { return I = [], a = a.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, function(a) { return I.push(a), "[FROALA.EDITOR.SCRIPT " + (I.length - 1) + "]" }), a = a.replace(/<noscript\b[^<]*(?:(?!<\/noscript>)<[^<]*)*<\/noscript>/gi, function(a) { return I.push(a), "[FROALA.EDITOR.NOSCRIPT " + (I.length - 1) + "]" }), a = a.replace(/<img((?:[\w\W]*?)) src="/g, '<img$1 data-fr-src="') }

        function f(a) { return a = a.replace(/\[FROALA\.EDITOR\.SCRIPT ([\d]*)\]/gi, function(a, c) { return b.opts.htmlRemoveTags.indexOf("script") >= 0 ? "" : I[parseInt(c, 10)] }), a = a.replace(/\[FROALA\.EDITOR\.NOSCRIPT ([\d]*)\]/gi, function(a, c) { return b.opts.htmlRemoveTags.indexOf("noscript") >= 0 ? "" : I[parseInt(c, 10)].replace(/\&lt;/g, "<").replace(/\&gt;/g, ">") }), a = a.replace(/<img((?:[\w\W]*?)) data-fr-src="/g, '<img$1 src="') }

        function g(a) { var b = a.replace(/;;/gi, ";"); return b = b.replace(/^;/gi, ""), ";" != b.charAt(b.length) && (b += ";"), b }

        function h(a) { var c; for (c in a)
                if (a.hasOwnProperty(c)) { var d = c.match(G),
                        e = null; "style" == c && b.opts.htmlAllowedStyleProps.length && (e = a[c].match(H)), d && e ? a[c] = g(e.join(";")) : d && ("style" != c || e) || delete a[c] }
            for (var f = "", h = Object.keys(a).sort(), i = 0; i < h.length; i++) c = h[i], f += a[c].indexOf('"') < 0 ? " " + c + '="' + a[c] + '"' : " " + c + "='" + a[c] + "'"; return f }

        function i(a, c, d) { if (b.opts.fullPage) { var e = b.html.extractDoctype(d),
                    f = h(b.html.extractNodeAttrs(d, "html"));
                c = null == c ? b.html.extractNode(d, "head") || "<title></title>" : c; var g = h(b.html.extractNodeAttrs(d, "head")),
                    i = h(b.html.extractNodeAttrs(d, "body")); return e + "<html" + f + "><head" + g + ">" + c + "</head><body" + i + ">" + a + "</body></html>" } return a }

        function j(c, e) { var f, g = a("<div>" + c + "</div>"),
                h = ""; if (g) { var i = b.node.contents(g.get(0)); for (f = 0; f < i.length; f++) e(i[f]); for (i = b.node.contents(g.get(0)), f = 0; f < i.length; f++) h += d(i[f]) } return h }

        function k(a, c, d) { a = e(a); var g = a,
                h = null;
            b.opts.fullPage && (g = b.html.extractNode(a, "body") || (a.indexOf("<body") >= 0 ? "" : a), d && (h = b.html.extractNode(a, "head") || "")), g = j(g, c), h && (h = j(h, c)); var k = i(g, h, a); return f(k) }

        function l(a) { return a.replace(/\u200b/g, "").length == a.length ? a : b.clean.exec(a, c) }

        function m() { var c = b.el.querySelectorAll(Object.keys(a.FE.HTML5Map).join(",")); if (c.length) { var d = !1;
                b.el.querySelector(".fr-marker") || (b.selection.save(), d = !0); for (var e = 0; e < c.length; e++) "" === b.node.attributes(c[e]) && a(c[e]).replaceWith("<" + a.FE.HTML5Map[c[e].tagName] + ">" + c[e].innerHTML + "</" + a.FE.HTML5Map[c[e].tagName] + ">");
                d && b.selection.restore() } }

        function n(a) { var c = b.doc.createElement("DIV"); return c.innerText = a, c.textContent }

        function o(c) { if ("SPAN" == c.tagName && (c.getAttribute("class") || "").indexOf("fr-marker") >= 0) return !1; if ("PRE" == c.tagName && q(c), c.nodeType == Node.ELEMENT_NODE && (c.getAttribute("data-fr-src") && 0 !== c.getAttribute("data-fr-src").indexOf("blob:") && c.setAttribute("data-fr-src", b.helpers.sanitizeURL(n(c.getAttribute("data-fr-src")))), c.getAttribute("href") && c.setAttribute("href", b.helpers.sanitizeURL(n(c.getAttribute("href")))), c.getAttribute("src") && c.setAttribute("src", b.helpers.sanitizeURL(n(c.getAttribute("src")))), ["TABLE", "TBODY", "TFOOT", "TR"].indexOf(c.tagName) >= 0 && (c.innerHTML = c.innerHTML.trim())), !b.opts.pasteAllowLocalImages && c.nodeType == Node.ELEMENT_NODE && "IMG" == c.tagName && c.getAttribute("data-fr-src") && 0 === c.getAttribute("data-fr-src").indexOf("file://")) return c.parentNode.removeChild(c), !1; if (c.nodeType == Node.ELEMENT_NODE && a.FE.HTML5Map[c.tagName] && "" === b.node.attributes(c)) { var d = a.FE.HTML5Map[c.tagName],
                    e = "<" + d + ">" + c.innerHTML + "</" + d + ">";
                c.insertAdjacentHTML("beforebegin", e), c = c.previousSibling, c.parentNode.removeChild(c.nextSibling) } if (b.opts.htmlAllowComments || c.nodeType != Node.COMMENT_NODE)
                if (c.tagName && c.tagName.match(F)) c.parentNode.removeChild(c);
                else if (c.tagName && !c.tagName.match(E)) "svg" === c.tagName ? c.parentNode.removeChild(c) : b.browser.safari && "path" == c.tagName && c.parentNode && "svg" == c.parentNode.tagName || (c.outerHTML = c.innerHTML);
            else { var f = c.attributes; if (f)
                    for (var h = f.length - 1; h >= 0; h--) { var i = f[h],
                            j = i.nodeName.match(G),
                            k = null; "style" == i.nodeName && b.opts.htmlAllowedStyleProps.length && (k = i.value.match(H)), j && k ? i.value = g(k.join(";")) : j && ("style" != i.nodeName || k) || c.removeAttribute(i.nodeName) } } else 0 !== c.data.indexOf("[FROALA.EDITOR") && c.parentNode.removeChild(c) }

        function p(a) { for (var c = b.node.contents(a), d = 0; d < c.length; d++) c[d].nodeType != Node.TEXT_NODE && p(c[d]);
            o(a) }

        function q(a) { var b = a.innerHTML;
            b.indexOf("\n") >= 0 && (a.innerHTML = b.replace(/\n/g, "<br>")) }

        function r(c, d, e, f) { "undefined" == typeof d && (d = []), "undefined" == typeof e && (e = []), "undefined" == typeof f && (f = !1), c = c.replace(/<br> */g, "<br>"); var g, h = a.merge([], b.opts.htmlAllowedTags); for (g = 0; g < d.length; g++) h.indexOf(d[g]) >= 0 && h.splice(h.indexOf(d[g]), 1); var i = a.merge([], b.opts.htmlAllowedAttrs); for (g = 0; g < e.length; g++) i.indexOf(e[g]) >= 0 && i.splice(i.indexOf(e[g]), 1); return i.push("data-fr-.*"), i.push("fr-.*"), E = new RegExp("^" + h.join("$|^") + "$", "gi"), G = new RegExp("^" + i.join("$|^") + "$", "gi"), F = new RegExp("^" + b.opts.htmlRemoveTags.join("$|^") + "$", "gi"), H = b.opts.htmlAllowedStyleProps.length ? new RegExp("((^|;|\\s)" + b.opts.htmlAllowedStyleProps.join(":.+?(?=;|$))|((^|;|\\s)") + ":.+?(?=(;)|$))", "gi") : null, c = k(c, p, !0) }

        function s() { for (var a = b.el.querySelectorAll("tr"), c = 0; c < a.length; c++) { for (var d = a[c].children, e = !0, f = 0; f < d.length; f++)
                    if ("TH" != d[f].tagName) { e = !1; break }
                if (e !== !1 && 0 !== d.length) { for (var g = a[c]; g && "TABLE" != g.tagName && "THEAD" != g.tagName;) g = g.parentNode; var h = g; "THEAD" != h.tagName && (h = b.doc.createElement("THEAD"), g.insertBefore(h, g.firstChild)), h.appendChild(a[c]) } } }

        function t() { s() }

        function u() { var a = [],
                c = function(a) { return !b.node.isList(a.parentNode) };
            do { if (a.length) { var d = a[0],
                        e = b.doc.createElement("ul");
                    d.parentNode.insertBefore(e, d);
                    do { var f = d;
                        d = d.nextSibling, e.appendChild(f) } while (d && "LI" == d.tagName) } a = []; for (var g = b.el.querySelectorAll("li"), h = 0; h < g.length; h++) c(g[h]) && a.push(g[h]) } while (a.length > 0) }

        function v() { for (var a = b.el.querySelectorAll("ol + ol, ul + ul"), c = 0; c < a.length; c++) { var d = a[c]; if (b.node.isList(d.previousSibling) && b.node.openTagString(d) == b.node.openTagString(d.previousSibling)) { for (var e = b.node.contents(d), f = 0; f < e.length; f++) d.previousSibling.appendChild(e[f]);
                    d.parentNode.removeChild(d) } } }

        function w() { var a, c, d = function(a) { a.querySelector("LI") || (c = !0, a.parentNode.removeChild(a)) };
            do { c = !1; var e = b.el.querySelectorAll("li:empty"); for (a = 0; a < e.length; a++) e[a].parentNode.removeChild(e[a]); var f = b.el.querySelectorAll("ul, ol"); for (a = 0; a < f.length; a++) d(f[a]) } while (c === !0) }

        function x() { for (var c = b.el.querySelectorAll("ul > ul, ol > ol, ul > ol, ol > ul"), d = 0; d < c.length; d++) { var e = c[d],
                    f = e.previousSibling;
                f && ("LI" == f.tagName ? f.appendChild(e) : a(e).wrap("<li></li>")) } }

        function y() { for (var c = b.el.querySelectorAll("li > ul, li > ol"), d = 0; d < c.length; d++) { var e = c[d]; if (e.nextSibling) { var f = e.nextSibling,
                        g = a("<li>");
                    a(e.parentNode).after(g);
                    do { var h = f;
                        f = f.nextSibling, g.append(h) } while (f) } } }

        function z() { for (var c = b.el.querySelectorAll("li > ul, li > ol"), d = 0; d < c.length; d++) { var e = c[d]; if (b.node.isFirstSibling(e)) a(e).before("<br/>");
                else if (e.previousSibling && "BR" == e.previousSibling.tagName) { for (var f = e.previousSibling.previousSibling; f && b.node.hasClass(f, "fr-marker");) f = f.previousSibling;
                    f && "BR" != f.tagName && a(e.previousSibling).remove() } } }

        function A() { for (var c = b.el.querySelectorAll("li:empty"), d = 0; d < c.length; d++) a(c[d]).remove() }

        function B() { for (var c = b.el.querySelectorAll("ul, ol"), d = 0; d < c.length; d++)
                for (var e = b.node.contents(c[d]), f = null, g = e.length - 1; g >= 0; g--) "LI" != e[g].tagName ? (f || (f = a("<li>"), f.insertBefore(e[g])), f.prepend(e[g])) : f = null }

        function C() { u(), v(), B(), w(), x(), y(), z(), A() }

        function D() { b.opts.fullPage && a.merge(b.opts.htmlAllowedTags, ["head", "title", "style", "link", "base", "body", "html", "meta"]) } var E, F, G, H, I = []; return { _init: D, html: r, toHTML5: m, tables: t, lists: C, invisibleSpaces: l, exec: k } }, a.FE.MODULES.spaces = function(b) {
        function c(c, d) { var e = c.previousSibling,
                f = c.nextSibling,
                g = c.textContent,
                h = c.parentNode; if (!b.html.isPreformatted(h)) { d && (g = g.replace(/[\f\n\r\t\v ]{2,}/g, " "), f && "BR" !== f.tagName && !b.node.isBlock(f) || !(b.node.isBlock(h) || b.node.isLink(h) || b.node.isElement(h)) || (g = g.replace(/[\f\n\r\t\v ]{1,}$/g, "")), e && "BR" !== e.tagName && !b.node.isBlock(e) || !(b.node.isBlock(h) || b.node.isLink(h) || b.node.isElement(h)) || (g = g.replace(/^[\f\n\r\t\v ]{1,}/g, "")), " " === g && (e && b.node.isVoid(e) || f && b.node.isVoid(f)) && (g = "")), g = g.replace(new RegExp(a.FE.UNICODE_NBSP, "g"), " "); for (var i = "", j = 0; j < g.length; j++) i += 32 != g.charCodeAt(j) || 0 !== j && 32 != i.charCodeAt(j - 1) ? g[j] : a.FE.UNICODE_NBSP;
                (!f || f && b.node.isBlock(f) || f && f.nodeType == Node.ELEMENT_NODE && b.win.getComputedStyle(f) && "block" == b.win.getComputedStyle(f).display) && (i = i.replace(/ $/, a.FE.UNICODE_NBSP)), !e || b.node.isVoid(e) || b.node.isBlock(e) || (i = i.replace(/^\u00A0([^ $])/, " $1"), 1 !== i.length || 160 !== i.charCodeAt(0) || !f || b.node.isVoid(f) || b.node.isBlock(f) || (i = " ")), i = i.replace(/([^ \u00A0])\u00A0([^ \u00A0])/g, "$1 $2"), c.textContent != i && (c.textContent = i) } }

        function d(a, d) { if ("undefined" != typeof a && a || (a = b.el), "undefined" == typeof d && (d = !1), !a.getAttribute || "false" != a.getAttribute("contenteditable"))
                if (a.nodeType == Node.TEXT_NODE) c(a, d);
                else if (a.nodeType == Node.ELEMENT_NODE)
                for (var e = b.doc.createTreeWalker(a, NodeFilter.SHOW_TEXT, b.node.filter(function(a) { for (var c = a.parentNode; c && c !== b.el;) { if ("STYLE" == c.tagName || "IFRAME" == c.tagName) return !1; if ("PRE" === c.tagName) return !1;
                            c = c.parentNode } return null != a.textContent.match(/([ \u00A0\f\n\r\t\v]{2,})|(^[ \u00A0\f\n\r\t\v]{1,})|([ \u00A0\f\n\r\t\v]{1,}$)/g) && !b.node.hasClass(a.parentNode, "fr-marker") }), !1); e.nextNode();) c(e.currentNode, d) }

        function e() { for (var a = [], c = b.el.querySelectorAll(".fr-marker"), e = 0; e < c.length; e++) { var f = null,
                    g = b.node.blockParent(c[e]);
                f = g ? g : c[e]; for (var h = f.nextSibling, i = f.previousSibling; h && "BR" == h.tagName;) h = h.nextSibling; for (; i && "BR" == i.tagName;) i = i.previousSibling;
                f && a.indexOf(f) < 0 && a.push(f), i && a.indexOf(i) < 0 && a.push(i), h && a.indexOf(h) < 0 && a.push(h) } for (var j = 0; j < a.length; j++) d(a[j]) } return { normalize: d, normalizeAroundCursor: e } }, a.FE.UNICODE_NBSP = String.fromCharCode(160), a.FE.VOID_ELEMENTS = ["area", "base", "br", "col", "embed", "hr", "img", "input", "keygen", "link", "menuitem", "meta", "param", "source", "track", "wbr"], a.FE.BLOCK_TAGS = ["address", "article", "aside", "audio", "blockquote", "canvas", "dd", "div", "dl", "dt", "fieldset", "figcaption", "figure", "footer", "form", "h1", "h2", "h3", "h4", "h5", "h6", "header", "hgroup", "hr", "li", "main", "nav", "noscript", "ol", "output", "p", "pre", "section", "table", "tbody", "td", "tfoot", "th", "thead", "tr", "ul", "video"], a.extend(a.FE.DEFAULTS, { htmlAllowedEmptyTags: ["textarea", "a", "iframe", "object", "video", "style", "script", ".fa", ".fr-emoticon", ".fr-inner"], htmlDoNotWrapTags: ["script", "style"], htmlSimpleAmpersand: !1, htmlIgnoreCSSProperties: [], htmlExecuteScripts: !0 }), a.FE.MODULES.html = function(b) {
        function c() { return b.opts.enter == a.FE.ENTER_P ? "p" : b.opts.enter == a.FE.ENTER_DIV ? "div" : b.opts.enter == a.FE.ENTER_BR ? null : void 0 }

        function d(a, c) { return !(!a || a === b.el) && (c ? ["PRE", "SCRIPT", "STYLE"].indexOf(a.tagName) != -1 || d(a.parentNode, c) : ["PRE", "SCRIPT", "STYLE"].indexOf(a.tagName) != -1) }

        function e(c) { var d, e = [],
                f = []; if (c) { var h = b.el.querySelectorAll(".fr-marker"); for (d = 0; d < h.length; d++) { var i = b.node.blockParent(h[d]) || h[d]; if (i) { var j = i.nextSibling,
                            k = i.previousSibling;
                        i && f.indexOf(i) < 0 && b.node.isBlock(i) && f.push(i), k && b.node.isBlock(k) && f.indexOf(k) < 0 && f.push(k), j && b.node.isBlock(j) && f.indexOf(j) < 0 && f.push(j) } } } else f = b.el.querySelectorAll(g()); var l = g(); for (l += "," + a.FE.VOID_ELEMENTS.join(","), l += ", .fr-inner", l += "," + b.opts.htmlAllowedEmptyTags.join(":not(.fr-marker),") + ":not(.fr-marker)", d = f.length - 1; d >= 0; d--)
                if (!(f[d].textContent && f[d].textContent.replace(/\u200B|\n/g, "").length > 0 || f[d].querySelectorAll(l).length > 0)) { for (var m = b.node.contents(f[d]), n = !1, o = 0; o < m.length; o++)
                        if (m[o].nodeType != Node.COMMENT_NODE && m[o].textContent && m[o].textContent.replace(/\u200B|\n/g, "").length > 0) { n = !0; break }
                    n || e.push(f[d]) }
            return e }

        function f() { return a.FE.BLOCK_TAGS.join(":empty, ") + ":empty" }

        function g() { return a.FE.BLOCK_TAGS.join(", ") }

        function h(c) { var d = a.merge([], a.FE.VOID_ELEMENTS);
            d = a.merge(d, b.opts.htmlAllowedEmptyTags), "undefined" == typeof c && (d = a.merge(d, a.FE.BLOCK_TAGS)); var e, f;
            e = b.el.querySelectorAll("*:empty:not(" + d.join("):not(") + "):not(.fr-marker)");
            do { f = !1; for (var g = 0; g < e.length; g++) 0 !== e[g].attributes.length && "undefined" == typeof e[g].getAttribute("href") || (e[g].parentNode.removeChild(e[g]), f = !0);
                e = b.el.querySelectorAll("*:empty:not(" + d.join("):not(") + "):not(.fr-marker)") } while (e.length && f) }

        function i(a, d) { var e = c(); if (d && (e = "div"), e) { for (var f = b.doc.createDocumentFragment(), g = null, h = !1, i = a.firstChild, j = !1; i;) { var k = i.nextSibling; if (i.nodeType == Node.ELEMENT_NODE && (b.node.isBlock(i) || b.opts.htmlDoNotWrapTags.indexOf(i.tagName.toLowerCase()) >= 0 && !b.node.hasClass(i, "fr-marker"))) g = null, f.appendChild(i.cloneNode(!0));
                    else if (i.nodeType != Node.ELEMENT_NODE && i.nodeType != Node.TEXT_NODE) g = null, f.appendChild(i.cloneNode(!0));
                    else if ("BR" == i.tagName) null == g ? (g = b.doc.createElement(e), j = !0, d && g.setAttribute("class", "fr-temp-div"), g.setAttribute("data-empty", !0), g.appendChild(i.cloneNode(!0)), f.appendChild(g)) : h === !1 && (g.appendChild(b.doc.createElement("br")), d && g.setAttribute("class", "fr-temp-div"), g.setAttribute("data-empty", !0)), g = null;
                    else { var l = i.textContent;
                        (i.nodeType !== Node.TEXT_NODE || l.replace(/\n/g, "").replace(/(^ *)|( *$)/g, "").length > 0 || l.length && l.indexOf("\n") < 0) && (null == g && (g = b.doc.createElement(e), j = !0, d && g.setAttribute("class", "fr-temp-div"), f.appendChild(g), h = !1), g.appendChild(i.cloneNode(!0)), h || b.node.hasClass(i, "fr-marker") || i.nodeType == Node.TEXT_NODE && 0 === l.replace(/ /g, "").length || (h = !0)) } i = k } j && (a.innerHTML = "", a.appendChild(f)) } }

        function j(a, b) { for (var c = 0; c < a.length; c++) i(a[c], b) }

        function k(a, c, d, e) { if (!b.$wp) return !1; "undefined" == typeof a && (a = !1), "undefined" == typeof c && (c = !1), "undefined" == typeof d && (d = !1), "undefined" == typeof e && (e = !1); var f = b.$wp.scrollTop();
            i(b.el, a), e && j(b.el.querySelectorAll(".fr-inner"), a), c && j(b.el.querySelectorAll("td, th"), a), d && j(b.el.querySelectorAll("blockquote"), a), f != b.$wp.scrollTop() && b.$wp.scrollTop(f) }

        function l() { b.$el.find("div.fr-temp-div").each(function() { a(this).attr("data-empty") || ["LI"].indexOf(this.parentNode.tagName) >= 0 || b.node.isBlock(this.nextSibling) && !a(this.nextSibling).hasClass("fr-temp-div") ? a(this).replaceWith(a(this).html()) : a(this).replaceWith(a(this).html() + "<br>") }), b.$el.find(".fr-temp-div").removeClass("fr-temp-div").filter(function() { return "" === a(this).attr("class") }).removeAttr("class") }

        function m(c) { for (var d = e(c), f = 0; f < d.length; f++) { var g = d[f]; "false" === g.getAttribute("contenteditable") || g.querySelector(b.opts.htmlAllowedEmptyTags.join(":not(.fr-marker),") + ":not(.fr-marker)") || b.node.isVoid(g) || "TABLE" != g.tagName && "TBODY" != g.tagName && "TR" != g.tagName && "UL" != g.tagName && "OL" != g.tagName && g.appendChild(b.doc.createElement("br")) } if (b.browser.msie && b.opts.enter == a.FE.ENTER_BR) { var h = b.node.contents(b.el);
                h.length && h[h.length - 1].nodeType == Node.TEXT_NODE && b.$el.append("<br>") } }

        function n() { return b.$el.get(0).querySelectorAll(g()) }

        function o(a) { if ("undefined" == typeof a && (a = b.el), a && ["SCRIPT", "STYLE", "PRE"].indexOf(a.tagName) >= 0) return !1; for (var c = b.doc.createTreeWalker(a, NodeFilter.SHOW_TEXT, b.node.filter(function(a) { return null != a.textContent.match(/([ \n]{2,})|(^[ \n]{1,})|([ \n]{1,}$)/g) }), !1); c.nextNode();) { var e = c.currentNode; if (!d(e.parentNode, !0)) { var f = b.node.isBlock(e.parentNode) || b.node.isElement(e.parentNode),
                        g = e.textContent.replace(/(?!^)( ){2,}(?!$)/g, " ").replace(/\n/g, " ").replace(/^[ ]{2,}/g, " ").replace(/[ ]{2,}$/g, " "); if (f) { var h = e.previousSibling,
                            i = e.nextSibling;
                        h && i && " " == g ? g = b.node.isBlock(h) && b.node.isBlock(i) ? "" : " " : (h || (g = g.replace(/^ */, "")), i || (g = g.replace(/ *$/, ""))) } e.textContent = g } } }

        function p(a, b, c) { var d = new RegExp(b, "gi"),
                e = d.exec(a); return e ? e[c] : null }

        function q(a, b) { var c = a.match(/<!DOCTYPE ?([^ ]*) ?([^ ]*) ?"?([^"]*)"? ?"?([^"]*)"?>/i); return c ? b.implementation.createDocumentType(c[1], c[3], c[4]) : b.implementation.createDocumentType("html") }

        function r(a) { var b = a.doctype,
                c = "<!DOCTYPE html>"; return b && (c = "<!DOCTYPE " + b.name + (b.publicId ? ' PUBLIC "' + b.publicId + '"' : "") + (!b.publicId && b.systemId ? " SYSTEM" : "") + (b.systemId ? ' "' + b.systemId + '"' : "") + ">"), c }

        function s(c) { var d = c.parentNode; if (d && (b.node.isBlock(d) || b.node.isElement(d)) && ["TD", "TH"].indexOf(d.tagName) < 0) { for (var e = c.previousSibling, f = c.nextSibling; e && e.nodeType == Node.TEXT_NODE && 0 === e.textContent.replace(/\n|\r/g, "").length;) e = e.previousSibling;
                e && d && "BR" != e.tagName && !b.node.isBlock(e) && !f && d.textContent.replace(/\u200B/g, "").length > 0 && e.textContent.length > 0 && !b.node.hasClass(e, "fr-marker") && (b.el == d && !f && b.opts.enter == a.FE.ENTER_BR && b.browser.msie || c.parentNode.removeChild(c)) } else !d || b.node.isBlock(d) || b.node.isElement(d) || c.previousSibling || c.nextSibling || s(c.parentNode) }

        function t() { for (var a = b.el.getElementsByTagName("br"), c = 0; c < a.length; c++) s(a[c]) }

        function u() { b.opts.htmlUntouched || (h(), k()), o(), b.opts.htmlUntouched || (b.spaces.normalize(null, !0), b.html.fillEmptyBlocks(), b.clean.lists(), b.clean.tables(), b.clean.toHTML5(), b.html.cleanBRs()), b.selection.restore(), v(), b.placeholder.refresh() }

        function v() { b.core.isEmpty() && (null != c() ? b.el.querySelector(g()) || b.el.querySelector(b.opts.htmlDoNotWrapTags.join(":not(.fr-marker),") + ":not(.fr-marker)") || (b.core.hasFocus() ? (b.$el.html("<" + c() + ">" + a.FE.MARKERS + "<br/></" + c() + ">"), b.selection.restore()) : b.$el.html("<" + c() + "><br/></" + c() + ">")) : b.el.querySelector("*:not(.fr-marker):not(br)") || (b.core.hasFocus() ? (b.$el.html(a.FE.MARKERS + "<br/>"), b.selection.restore()) : b.$el.html("<br/>"))) }

        function w(a, b) { return p(a, "<" + b + "[^>]*?>([\\w\\W]*)</" + b + ">", 1) }

        function x(c, d) { var e = a("<div " + (p(c, "<" + d + "([^>]*?)>", 1) || "") + ">"); return b.node.rawAttributes(e.get(0)) }

        function y(a) { return (p(a, "<!DOCTYPE([^>]*?)>", 0) || "<!DOCTYPE html>").replace(/\n/g, " ").replace(/ {2,}/g, " ") }

        function z(a, c) { b.opts.htmlExecuteScripts ? a.html(c) : a.get(0).innerHTML = c }

        function A(c) {
            var d = b.clean.html((c || "").trim(), [], [], b.opts.fullPage);
            if (b.opts.fullPage) { var e = w(d, "body") || (d.indexOf("<body") >= 0 ? "" : d),
                    f = x(d, "body"),
                    g = w(d, "head") || "<title></title>",
                    h = x(d, "head"),
                    i = a("<div>").append(g).contents().each(function() {
                        (this.nodeType == Node.COMMENT_NODE || ["BASE", "LINK", "META", "NOSCRIPT", "SCRIPT", "STYLE", "TEMPLATE", "TITLE"].indexOf(this.tagName) >= 0) && this.parentNode.removeChild(this) }).end().html().trim();
                g = a("<div>").append(g).contents().map(function() { return this.nodeType == Node.COMMENT_NODE ? "<!--" + this.nodeValue + "-->" : ["BASE", "LINK", "META", "NOSCRIPT", "SCRIPT", "STYLE", "TEMPLATE", "TITLE"].indexOf(this.tagName) >= 0 ? this.outerHTML : "" }).toArray().join(""); var j = y(d),
                    k = x(d, "html");
                z(b.$el, i + "\n" + e), b.node.clearAttributes(b.el), b.$el.attr(f), b.$el.addClass("fr-view"), b.$el.attr("spellcheck", b.opts.spellcheck), b.$el.attr("dir", b.opts.direction), z(b.$head, g), b.node.clearAttributes(b.$head.get(0)), b.$head.attr(h), b.node.clearAttributes(b.$html.get(0)), b.$html.attr(k), b.iframe_document.doctype.parentNode.replaceChild(q(j, b.iframe_document), b.iframe_document.doctype) } else z(b.$el, d);
            var l = b.edit.isDisabled();
            b.edit.on(), b.core.injectStyle(b.opts.iframeStyle), u(), b.opts.useClasses || (b.$el.find("[fr-original-class]").each(function() { this.setAttribute("class", this.getAttribute("fr-original-class")), this.removeAttribute("fr-original-class") }), b.$el.find("[fr-original-style]").each(function() {
                this.setAttribute("style", this.getAttribute("fr-original-style")), this.removeAttribute("fr-original-style")
            })), l && b.edit.off(), b.events.trigger("html.set")
        }

        function B(a) { var b = /(#[^\s\+>~\.\[:]+)/g,
                c = /(\[[^\]]+\])/g,
                d = /(\.[^\s\+>~\.\[:]+)/g,
                e = /(::[^\s\+>~\.\[:]+|:first-line|:first-letter|:before|:after)/gi,
                f = /(:[\w-]+\([^\)]*\))/gi,
                g = /(:[^\s\+>~\.\[:]+)/g,
                h = /([^\s\+>~\.\[:]+)/g;! function() { var b = /:not\(([^\)]*)\)/g;
                b.test(a) && (a = a.replace(b, "     $1 ")) }(); var i = 100 * (a.match(b) || []).length + 10 * (a.match(c) || []).length + 10 * (a.match(d) || []).length + 10 * (a.match(f) || []).length + 10 * (a.match(g) || []).length + (a.match(e) || []).length; return a = a.replace(/[\*\s\+>~]/g, " "), a = a.replace(/[#\.]/g, " "), i += (a.match(h) || []).length }

        function C(a) { if (b.events.trigger("html.processGet", [a]), a && a.getAttribute && "" === a.getAttribute("class") && a.removeAttribute("class"), a && a.getAttribute && "" === a.getAttribute("style") && a.removeAttribute("style"), a && a.nodeType == Node.ELEMENT_NODE) { var c, d = a.querySelectorAll('[class=""],[style=""]'); for (c = 0; c < d.length; c++) { var e = d[c]; "" === e.getAttribute("class") && e.removeAttribute("class"), "" === e.getAttribute("style") && e.removeAttribute("style") } var f = a.querySelectorAll("br"); for (c = 0; c < f.length; c++) s(f[c]) } }

        function D(a, b) { return a[3] - b[3] }

        function E(a, c) { if (!b.$wp) return b.$oel.clone().removeClass("fr-view").removeAttr("contenteditable").get(0).outerHTML; var d = "";
            b.events.trigger("html.beforeGet"); var e, f, g = [],
                h = {},
                i = []; if (!b.opts.useClasses && !c) { var j = new RegExp("^" + b.opts.htmlIgnoreCSSProperties.join("$|^") + "$", "gi"); for (e = 0; e < b.doc.styleSheets.length; e++) { var k, l = 0; try { k = b.doc.styleSheets[e].cssRules, b.doc.styleSheets[e].ownerNode && "STYLE" == b.doc.styleSheets[e].ownerNode.nodeType && (l = 1) } catch (m) {} if (k)
                        for (var n = 0, o = k.length; n < o; n++)
                            if (k[n].selectorText && k[n].style.cssText.length > 0) { var p, q = k[n].selectorText.replace(/body |\.fr-view /g, "").replace(/::/g, ":"); try { p = b.el.querySelectorAll(q) } catch (m) { p = [] } for (f = 0; f < p.length; f++) {!p[f].getAttribute("fr-original-style") && p[f].getAttribute("style") ? (p[f].setAttribute("fr-original-style", p[f].getAttribute("style")), g.push(p[f])) : p[f].getAttribute("fr-original-style") || (p[f].setAttribute("fr-original-style", ""), g.push(p[f])), h[p[f]] || (h[p[f]] = {}); for (var s = 1e3 * l + B(k[n].selectorText), t = k[n].style.cssText.split(";"), u = 0; u < t.length; u++) { var v = t[u].trim().split(":")[0];
                                        v.match(j) || (h[p[f]][v] || (h[p[f]][v] = 0, (p[f].getAttribute("fr-original-style") || "").indexOf(v + ":") >= 0 && (h[p[f]][v] = 1e4)), s >= h[p[f]][v] && (h[p[f]][v] = s, t[u].trim().length && i.push([p[f], v.trim(), t[u].trim().split(":")[1].trim(), s]))) } } } } for (i.sort(D), e = 0; e < i.length; e++) { var w = i[e];
                    w[0].style[w[1]] = w[2] } for (e = 0; e < g.length; e++)
                    if (g[e].getAttribute("class") && (g[e].setAttribute("fr-original-class", g[e].getAttribute("class")), g[e].removeAttribute("class")), (g[e].getAttribute("fr-original-style") || "").trim().length > 0) { var x = g[e].getAttribute("fr-original-style").split(";"); for (f = 0; f < x.length; f++) x[f].indexOf(":") > 0 && (g[e].style[x[f].split(":")[0].trim()] = x[f].split(":")[1].trim()) } } if (b.core.isEmpty() ? b.opts.fullPage && (d = r(b.iframe_document), d += "<html" + b.node.attributes(b.$html.get(0)) + ">" + b.$html.find("head").get(0).outerHTML + "<body></body></html>") : ("undefined" == typeof a && (a = !1), b.opts.fullPage ? (d = r(b.iframe_document), b.$el.removeClass("fr-view"), d += "<html" + b.node.attributes(b.$html.get(0)) + ">" + b.$html.html() + "</html>", b.$el.addClass("fr-view")) : d = b.$el.html()), !b.opts.useClasses && !c)
                for (e = 0; e < g.length; e++) g[e].getAttribute("fr-original-class") && (g[e].setAttribute("class", g[e].getAttribute("fr-original-class")), g[e].removeAttribute("fr-original-class")), g[e].getAttribute("fr-original-style") ? (g[e].setAttribute("style", g[e].getAttribute("fr-original-style")), g[e].removeAttribute("fr-original-style")) : g[e].removeAttribute("style");
            b.opts.fullPage && (d = d.replace(/<style data-fr-style="true">(?:[\w\W]*?)<\/style>/g, ""), d = d.replace(/<link([^>]*)data-fr-style="true"([^>]*)>/g, ""), d = d.replace(/<style(?:[\w\W]*?)class="firebugResetStyles"(?:[\w\W]*?)>(?:[\w\W]*?)<\/style>/g, ""), d = d.replace(/<body((?:[\w\W]*?)) spellcheck="true"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$2>$3</body>"), d = d.replace(/<body((?:[\w\W]*?)) contenteditable="(true|false)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$3>$4</body>"), d = d.replace(/<body((?:[\w\W]*?)) dir="([\w]*)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$3>$4</body>"), d = d.replace(/<body((?:[\w\W]*?))class="([\w\W]*?)(fr-rtl|fr-ltr)([\w\W]*?)"((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, '<body$1class="$2$4"$5>$6</body>'), d = d.replace(/<body((?:[\w\W]*?)) class=""((?:[\w\W]*?))>((?:[\w\W]*?))<\/body>/g, "<body$1$2>$3</body>")), b.opts.htmlSimpleAmpersand && (d = d.replace(/\&amp;/gi, "&")), b.events.trigger("html.afterGet"), a || (d = d.replace(/<span[^>]*? class\s*=\s*["']?fr-marker["']?[^>]+>\u200b<\/span>/gi, "")), d = b.clean.invisibleSpaces(d), d = b.clean.exec(d, C); var y = b.events.chainTrigger("html.get", d); return "string" == typeof y && (d = y), d = d.replace(/<pre(?:[\w\W]*?)>(?:[\w\W]*?)<\/pre>/g, function(a) { return a.replace(/<br>/g, "\n") }) }

        function F() { var c = function(c, d) { for (; d && (d.nodeType == Node.TEXT_NODE || !b.node.isBlock(d)) && !b.node.isElement(d);) d && d.nodeType != Node.TEXT_NODE && a(c).wrapInner(b.node.openTagString(d) + b.node.closeTagString(d)), d = d.parentNode;
                    d && c.innerHTML == d.innerHTML && (c.innerHTML = d.outerHTML) },
                d = function() { var c, d = null; return b.win.getSelection ? (c = b.win.getSelection(), c && c.rangeCount && (d = c.getRangeAt(0).commonAncestorContainer, d.nodeType != Node.ELEMENT_NODE && (d = d.parentNode))) : (c = b.doc.selection) && "Control" != c.type && (d = c.createRange().parentElement()), null != d && (a.inArray(b.el, a(d).parents()) >= 0 || d == b.el) ? d : null },
                e = ""; if ("undefined" != typeof b.win.getSelection) { b.browser.mozilla && (b.selection.save(), b.$el.find('.fr-marker[data-type="false"]').length > 1 && (b.$el.find('.fr-marker[data-type="false"][data-id="0"]').remove(), b.$el.find('.fr-marker[data-type="false"]:last').attr("data-id", "0"), b.$el.find(".fr-marker").not('[data-id="0"]').remove()), b.selection.restore()); for (var f = b.selection.ranges(), g = 0; g < f.length; g++) { var h = document.createElement("div");
                    h.appendChild(f[g].cloneContents()); var i = h.children; if (i.length) { var j = i[i.length - 1];
                        ("P" == j.tagName && b.opts.enter == a.FroalaEditor.ENTER_P || "DIV" == j.tagName && b.opts.enter == a.FroalaEditor.ENTER_DIV) && b.node.isEmpty(j) && h.removeChild(j) } c(h, d()), a(h).find(".fr-element").length > 0 && (h = b.el), e += h.innerHTML } } else "undefined" != typeof b.doc.selection && "Text" == b.doc.selection.type && (e = b.doc.selection.createRange().htmlText); return e }

        function G(a) { var c = b.doc.createElement("div"); return c.innerHTML = a, null !== c.querySelector(g()) }

        function H(a) { var c = b.doc.createElement("div"); return c.innerHTML = a, b.selection.setAtEnd(c), c.innerHTML }

        function I(a) { return a.replace(/</gi, "&lt;").replace(/>/gi, "&gt;").replace(/"/gi, "&quot;").replace(/'/gi, "&#39;") }

        function J(c) { if (!b.html.defaultTag()) return c; var d = b.doc.createElement("div");
            d.innerHTML = c; for (var e = d.querySelectorAll(":scope > " + b.html.defaultTag()), f = e.length - 1; f >= 0; f--) { var g = e[f];
                b.node.isBlock(g.previousSibling) || (g.previousSibling && !b.node.isEmpty(g) && a("<br>").insertAfter(g.previousSibling), g.outerHTML = g.innerHTML) } return d.innerHTML }

        function K(c, d, e) { b.selection.isCollapsed() || b.selection.remove(); var f; if (f = d ? c : b.clean.html(c), f = f.replace(/\r|\n/g, " "), c.indexOf('class="fr-marker"') < 0 && (f = H(f)), b.core.isEmpty() && !b.opts.keepFormatOnDelete && G(f)) b.el.innerHTML = f;
            else { var g = b.markers.insert(); if (g) { b.node.isLastSibling(g) && a(g).parent().hasClass("fr-deletable") && a(g).insertAfter(a(g).parent()); var h, i = b.node.blockParent(g); if ((G(f) || e) && (h = b.node.deepestParent(g) || i && "LI" == i.tagName)) { if (i && "LI" == i.tagName && (f = J(f)), g = b.markers.split(), !g) return !1;
                        g.outerHTML = f } else g.outerHTML = f } else b.el.innerHTML = b.el.innerHTML + f } u(), b.keys.positionCaret(), b.events.trigger("html.inserted") }

        function L(c) { var d = null; if ("undefined" == typeof c && (d = b.selection.element()), b.opts.keepFormatOnDelete) return !1; var e = d ? (d.textContent.match(/\u200B/g) || []).length - d.querySelectorAll(".fr-marker").length : 0,
                f = (b.el.textContent.match(/\u200B/g) || []).length - b.el.querySelectorAll(".fr-marker").length; if (f == e) return !1; var g, h;
            do { h = !1, g = b.el.querySelectorAll("*:not(.fr-marker)"); for (var i = 0; i < g.length; i++) { var j = g[i]; if (d != j) { var k = j.textContent;
                        0 === j.children.length && 1 === k.length && 8203 == k.charCodeAt(0) && "TD" !== j.tagName && (a(j).remove(), h = !0) } } } while (h) }

        function M() { if (b.$wp) { var a = function() { L(), b.placeholder && setTimeout(b.placeholder.refresh, 0) };
                b.events.on("mouseup", a), b.events.on("keydown", a), b.events.on("contentChanged", v) } }
        return { defaultTag: c, isPreformatted: d, emptyBlocks: e, emptyBlockTagsQuery: f, blockTagsQuery: g, fillEmptyBlocks: m, cleanEmptyTags: h, cleanWhiteTags: L, cleanBlankSpaces: o, blocks: n, getDoctype: r, set: A, get: E, getSelected: F, insert: K, wrap: k, unwrap: l, escapeEntities: I, checkIfEmpty: v, extractNode: w, extractNodeAttrs: x, extractDoctype: y, cleanBRs: t, _init: M }
    }, a.extend(a.FE.DEFAULTS, { height: null, heightMax: null, heightMin: null, width: null }), a.FE.MODULES.size = function(a) {
        function b() { c(), a.opts.height && a.$el.css("minHeight", a.opts.height - a.helpers.getPX(a.$el.css("padding-top")) - a.helpers.getPX(a.$el.css("padding-bottom"))), a.$iframe.height(a.$el.outerHeight(!0)) }

        function c() { a.opts.heightMin ? a.$el.css("minHeight", a.opts.heightMin) : a.$el.css("minHeight", ""), a.opts.heightMax ? (a.$wp.css("maxHeight", a.opts.heightMax), a.$wp.css("overflow", "auto")) : (a.$wp.css("maxHeight", ""), a.$wp.css("overflow", "")), a.opts.height ? (a.$wp.height(a.opts.height), a.$wp.css("overflow", "auto"), a.$el.css("minHeight", a.opts.height - a.helpers.getPX(a.$el.css("padding-top")) - a.helpers.getPX(a.$el.css("padding-bottom")))) : (a.$wp.css("height", ""), a.opts.heightMin || a.$el.css("minHeight", ""), a.opts.heightMax || a.$wp.css("overflow", "")), a.opts.width && a.$box.width(a.opts.width) }

        function d() { return !!a.$wp && (c(), void(a.$iframe && (a.events.on("keyup keydown", function() { setTimeout(b, 0) }, !0), a.events.on("commands.after html.set init initialized paste.after", b)))) } return { _init: d, syncIframe: b, refresh: c } }, a.extend(a.FE.DEFAULTS, { language: null }), a.FE.LANGUAGE = {}, a.FE.MODULES.language = function(b) {
        function c(a) { return e && e.translation[a] && e.translation[a].length ? e.translation[a] : a }

        function d() { a.FE.LANGUAGE && (e = a.FE.LANGUAGE[b.opts.language]), e && e.direction && (b.opts.direction = e.direction) } var e; return { _init: d, translate: c } }, a.extend(a.FE.DEFAULTS, { placeholderText: "Type something" }), a.FE.MODULES.placeholder = function(b) {
        function c() { b.$placeholder || g(); var c = b.opts.iframe ? b.$iframe.prev().outerHeight(!0) : b.$el.prev().outerHeight(!0),
                d = 0,
                e = 0,
                f = 0,
                h = 0,
                i = 0,
                j = 0,
                k = b.node.contents(b.el),
                l = a(b.selection.element()).css("text-align"); if (k.length && k[0].nodeType == Node.ELEMENT_NODE) { var m = a(k[0]);
                (!b.opts.toolbarInline || b.$el.prev().length > 0) && b.ready && (d = b.helpers.getPX(m.css("margin-top")), h = b.helpers.getPX(m.css("padding-top")), e = b.helpers.getPX(m.css("margin-left")), f = b.helpers.getPX(m.css("margin-right")), i = b.helpers.getPX(m.css("padding-left")), j = b.helpers.getPX(m.css("padding-right"))), b.$placeholder.css("font-size", m.css("font-size")), b.$placeholder.css("line-height", m.css("line-height")) } else b.$placeholder.css("font-size", b.$el.css("font-size")), b.$placeholder.css("line-height", b.$el.css("line-height"));
            b.$wp.addClass("show-placeholder"), b.$placeholder.css({ marginTop: Math.max(b.helpers.getPX(b.$el.css("margin-top")), d) + c, paddingTop: Math.max(b.helpers.getPX(b.$el.css("padding-top")), h), paddingLeft: Math.max(b.helpers.getPX(b.$el.css("padding-left")), i), marginLeft: Math.max(b.helpers.getPX(b.$el.css("margin-left")), e), paddingRight: Math.max(b.helpers.getPX(b.$el.css("padding-right")), j), marginRight: Math.max(b.helpers.getPX(b.$el.css("margin-right")), f), textAlign: l }).text(b.language.translate(b.opts.placeholderText || b.$oel.attr("placeholder") || "")), b.$placeholder.html(b.$placeholder.text().replace(/\n/g, "<br>")) }

        function d() { b.$wp.removeClass("show-placeholder") }

        function e() { return !b.$wp || b.node.hasClass(b.$wp.get(0), "show-placeholder") }

        function f() { return !!b.$wp && void(b.core.isEmpty() ? c() : d()) }

        function g() { b.$placeholder = a('<span class="fr-placeholder"></span>'), b.$wp.append(b.$placeholder) }

        function h() { return !!b.$wp && void b.events.on("init input keydown keyup contentChanged initialized", f) } return { _init: h, show: c, hide: d, refresh: f, isVisible: e } }, a.FE.MODULES.edit = function(a) {
        function b() { if (a.browser.mozilla) try { a.doc.execCommand("enableObjectResizing", !1, "false"), a.doc.execCommand("enableInlineTableEditing", !1, "false") } catch (b) {}
            if (a.browser.msie) try { a.doc.body.addEventListener("mscontrolselect", function(a) { return a.preventDefault(), !1 }) } catch (b) {} }

        function c() { a.$wp ? (a.$el.attr("contenteditable", !0), a.$el.removeClass("fr-disabled").attr("aria-disabled", !1), a.$tb && a.$tb.removeClass("fr-disabled").attr("aria-disabled", !1), b()) : a.$el.is("a") && a.$el.attr("contenteditable", !0), g = !1 }

        function d() { a.events.disableBlur(), a.$wp ? (a.$el.attr("contenteditable", !1), a.$el.addClass("fr-disabled").attr("aria-disabled", !0), a.$tb && a.$tb.addClass("fr-disabled").attr("aria-disabled", !0)) : a.$el.is("a") && a.$el.attr("contenteditable", !1), a.events.enableBlur(), g = !0 }

        function e() { return g }

        function f() { a.events.on("focus", function() { e() ? a.edit.off() : a.edit.on() }) } var g = !1; return { _init: f, on: c, off: d, disableDesign: b, isDisabled: e } }, a.extend(a.FE.DEFAULTS, { editorClass: null, typingTimer: 500, iframe: !1, requestWithCORS: !0, requestWithCredentials: !1, requestHeaders: {}, useClasses: !0, spellcheck: !0, iframeStyle: 'html{margin:0px;height:auto;}body{height:auto;padding:10px;background:transparent;color:#000000;position:relative;z-index: 2;-webkit-user-select:auto;margin:0px;overflow:hidden;min-height:20px;}body:after{content:"";display:block;clear:both;}', iframeStyleFiles: [], direction: "auto", zIndex: 1, tabIndex: null, disableRightClick: !1, scrollableContainer: "body", keepFormatOnDelete: !1, theme: null }), a.FE.MODULES.core = function(b) {
        function c(c) { if (b.opts.iframe) { b.$head.find("style[data-fr-style], link[data-fr-style]").remove(), b.$head.append('<style data-fr-style="true">' + c + "</style>"); for (var d = 0; d < b.opts.iframeStyleFiles.length; d++) { var e = a('<link data-fr-style="true" rel="stylesheet" href="' + b.opts.iframeStyleFiles[d] + '">');
                    e.get(0).addEventListener("load", b.size.syncIframe), b.$head.append(e) } } }

        function d() { b.opts.iframe || b.$el.addClass("fr-element fr-view") }

        function e() { if (b.$box.addClass("fr-box" + (b.opts.editorClass ? " " + b.opts.editorClass : "")), b.$wp.addClass("fr-wrapper"), d(), b.opts.iframe) { b.$iframe.addClass("fr-iframe"), b.$el.addClass("fr-view"); for (var a = 0; a < b.o_doc.styleSheets.length; a++) { var c; try { c = b.o_doc.styleSheets[a].cssRules } catch (e) {} if (c)
                        for (var f = 0, g = c.length; f < g; f++) !c[f].selectorText || 0 !== c[f].selectorText.indexOf(".fr-view") && 0 !== c[f].selectorText.indexOf(".fr-element") || c[f].style.cssText.length > 0 && (0 === c[f].selectorText.indexOf(".fr-view") ? b.opts.iframeStyle += c[f].selectorText.replace(/\.fr-view/g, "body") + "{" + c[f].style.cssText + "}" : b.opts.iframeStyle += c[f].selectorText.replace(/\.fr-element/g, "body") + "{" + c[f].style.cssText + "}") } } "auto" != b.opts.direction && b.$box.removeClass("fr-ltr fr-rtl").addClass("fr-" + b.opts.direction), b.$el.attr("dir", b.opts.direction), b.$wp.attr("dir", b.opts.direction), b.opts.zIndex > 1 && b.$box.css("z-index", b.opts.zIndex), b.opts.theme && b.$box.addClass(b.opts.theme + "-theme"), b.opts.tabIndex = b.opts.tabIndex || b.$oel.attr("tabIndex"), b.opts.tabIndex && b.$el.attr("tabIndex", b.opts.tabIndex) }

        function f() { return b.node.isEmpty(b.el) }

        function g() { b.drag_support = { filereader: "undefined" != typeof FileReader, formdata: !!b.win.FormData, progress: "upload" in new XMLHttpRequest } }

        function h(a, c) { var d = new XMLHttpRequest;
            d.open(c, a, !0), b.opts.requestWithCredentials && (d.withCredentials = !0); for (var e in b.opts.requestHeaders) b.opts.requestHeaders.hasOwnProperty(e) && d.setRequestHeader(e, b.opts.requestHeaders[e]); return d }

        function i(a) { "TEXTAREA" == b.$oel.get(0).tagName && b.$oel.val(a), b.$wp && ("TEXTAREA" == b.$oel.get(0).tagName ? (b.$el.html(""), b.$wp.html(""), b.$box.replaceWith(b.$oel), b.$oel.show()) : (b.$wp.replaceWith(a), b.$el.html(""), b.$box.removeClass("fr-view fr-ltr fr-box " + (b.opts.editorClass || "")), b.opts.theme && b.$box.addClass(b.opts.theme + "-theme"))), this.$wp = null, this.$el = null, this.el = null, this.$box = null }

        function j() { return b.browser.mozilla && b.helpers.isMobile() ? b.selection.inEditor() : b.node.hasFocus(b.el) || b.$el.find("*:focus").length > 0 }

        function k(a) { if (!a) return !1; var c = a.data("instance"); return !!c && c.id == b.id }

        function l() { if (a.FE.INSTANCES.push(b), g(), b.$wp) { e(), b.html.set(b._original_html), b.$el.attr("spellcheck", b.opts.spellcheck), b.helpers.isMobile() && (b.$el.attr("autocomplete", b.opts.spellcheck ? "on" : "off"), b.$el.attr("autocorrect", b.opts.spellcheck ? "on" : "off"), b.$el.attr("autocapitalize", b.opts.spellcheck ? "on" : "off")), b.opts.disableRightClick && b.events.$on(b.$el, "contextmenu", function(a) { if (2 == a.button) return !1 }); try { b.doc.execCommand("styleWithCSS", !1, !1) } catch (c) {} } "TEXTAREA" == b.$oel.get(0).tagName && (b.events.on("contentChanged", function() { b.$oel.val(b.html.get()) }), b.events.on("form.submit", function() { b.$oel.val(b.html.get()) }), b.events.on("form.reset", function() { b.html.set(b._original_html) }), b.$oel.val(b.html.get())), b.helpers.isIOS() && b.events.$on(b.$doc, "selectionchange", function() { b.$doc.get(0).hasFocus() || b.$win.get(0).focus() }), b.events.trigger("init") } return { _init: l, destroy: i, isEmpty: f, getXHR: h, injectStyle: c, hasFocus: j, sameInstance: k } }, a.FE.MODULES.cursorLists = function(b) {
        function c(a) { for (var b = a;
                "LI" != b.tagName;) b = b.parentNode; return b }

        function d(a) { for (var c = a; !b.node.isList(c);) c = c.parentNode; return c }

        function e(e) { var f, g = c(e),
                h = g.nextSibling,
                i = g.previousSibling,
                j = b.html.defaultTag(); if (b.node.isEmpty(g, !0) && h) { for (var k = "", l = "", m = e.parentNode; !b.node.isList(m) && m.parentNode && "LI" !== m.parentNode.tagName;) k = b.node.openTagString(m) + k, l += b.node.closeTagString(m), m = m.parentNode;
                k = b.node.openTagString(m) + k, l += b.node.closeTagString(m); var n = ""; for (n = m.parentNode && "LI" == m.parentNode.tagName ? l + "<li>" + a.FE.MARKERS + "<br>" + k : j ? l + "<" + j + ">" + a.FE.MARKERS + "<br></" + j + ">" + k : l + a.FE.MARKERS + "<br>" + k, a(g).html('<span id="fr-break"></span>');
                    ["UL", "OL"].indexOf(m.tagName) < 0 || m.parentNode && "LI" === m.parentNode.tagName;) m = m.parentNode; var o = b.node.openTagString(m) + a(m).html() + b.node.closeTagString(m);
                o = o.replace(/<span id="fr-break"><\/span>/g, n), a(m).replaceWith(o), b.$el.find("li:empty").remove() } else if (i && h || !b.node.isEmpty(g, !0)) { for (var p = "<br>", q = e.parentNode; q && "LI" != q.tagName;) p = b.node.openTagString(q) + p + b.node.closeTagString(q), q = q.parentNode;
                a(g).before("<li>" + p + "</li>"), a(e).remove() } else if (i) { f = d(g); for (var r = a.FE.MARKERS + "<br>", s = e.parentNode; s && "LI" != s.tagName;) r = b.node.openTagString(s) + r + b.node.closeTagString(s), s = s.parentNode;
                f.parentNode && "LI" == f.parentNode.tagName ? a(f.parentNode).after("<li>" + r + "</li>") : j ? a(f).after("<" + j + ">" + r + "</" + j + ">") : a(f).after(r), a(g).remove() } else f = d(g), f.parentNode && "LI" == f.parentNode.tagName ? h ? a(f.parentNode).before(b.node.openTagString(g) + a.FE.MARKERS + "<br></li>") : a(f.parentNode).after(b.node.openTagString(g) + a.FE.MARKERS + "<br></li>") : j ? a(f).before("<" + j + ">" + a.FE.MARKERS + "<br></" + j + ">") : a(f).before(a.FE.MARKERS + "<br>"), a(g).remove() }

        function f(d) { for (var e = c(d), f = "", g = d, h = "", i = ""; g != e;) { g = g.parentNode; var j = "A" == g.tagName && b.cursor.isAtEnd(d, g) ? "fr-to-remove" : "";
                h = b.node.openTagString(a(g).clone().addClass(j).get(0)) + h, i = b.node.closeTagString(g) + i } f = i + f + h + a.FE.MARKERS + a.FE.INVISIBLE_SPACE, a(d).replaceWith('<span id="fr-break"></span>'); var k = b.node.openTagString(e) + a(e).html() + b.node.closeTagString(e);
            k = k.replace(/<span id="fr-break"><\/span>/g, f), a(e).replaceWith(k) }

        function g(d) { for (var e = c(d), f = a.FE.MARKERS, g = "", h = d, i = !1; h != e;) { h = h.parentNode; var j = "A" == h.tagName && b.cursor.isAtEnd(d, h) ? "fr-to-remove" : "";
                i || h == e || b.node.isBlock(h) || (i = !0, g += a.FE.INVISIBLE_SPACE), g = b.node.openTagString(a(h).clone().addClass(j).get(0)) + g, f += b.node.closeTagString(h) } var k = g + f;
            a(d).remove(), a(e).after(k) }

        function h(e) { var f = c(e),
                g = f.previousSibling; if (g) { g = a(g).find(b.html.blockTagsQuery()).get(-1) || g, a(e).replaceWith(a.FE.MARKERS); var h = b.node.contents(g);
                h.length && "BR" == h[h.length - 1].tagName && a(h[h.length - 1]).remove(), a(f).find(b.html.blockTagsQuery()).not("ol, ul, table").each(function() { this.parentNode == f && a(this).replaceWith(a(this).html() + (b.node.isEmpty(this) ? "" : "<br>")) }); for (var i, j = b.node.contents(f)[0]; j && !b.node.isList(j);) i = j.nextSibling, a(g).append(j), j = i; for (g = f.previousSibling; j;) i = j.nextSibling, a(g).append(j), j = i;
                a(f).remove() } else { var k = d(f); if (a(e).replaceWith(a.FE.MARKERS), k.parentNode && "LI" == k.parentNode.tagName) { var l = k.previousSibling;
                    b.node.isBlock(l) ? (a(f).find(b.html.blockTagsQuery()).not("ol, ul, table").each(function() { this.parentNode == f && a(this).replaceWith(a(this).html() + (b.node.isEmpty(this) ? "" : "<br>")) }), a(l).append(a(f).html())) : a(k).before(a(f).html()) } else { var m = b.html.defaultTag();
                    m && 0 === a(f).find(b.html.blockTagsQuery()).length ? a(k).before("<" + m + ">" + a(f).html() + "</" + m + ">") : a(k).before(a(f).html()) } a(f).remove(), b.html.wrap(), 0 === a(k).find("li").length && a(k).remove() } }

        function i(d) { var e, f = c(d),
                g = f.nextSibling; if (g) { e = b.node.contents(g), e.length && "BR" == e[0].tagName && a(e[0]).remove(), a(g).find(b.html.blockTagsQuery()).not("ol, ul, table").each(function() { this.parentNode == g && a(this).replaceWith(a(this).html() + (b.node.isEmpty(this) ? "" : "<br>")) }); for (var h, i = d, j = b.node.contents(g)[0]; j && !b.node.isList(j);) h = j.nextSibling, a(i).after(j), i = j, j = h; for (; j;) h = j.nextSibling, a(f).append(j), j = h;
                a(d).replaceWith(a.FE.MARKERS), a(g).remove() } else { for (var k = f; !k.nextSibling && k != b.el;) k = k.parentNode; if (k == b.el) return !1; if (k = k.nextSibling, b.node.isBlock(k)) a.FE.NO_DELETE_TAGS.indexOf(k.tagName) < 0 && (a(d).replaceWith(a.FE.MARKERS), e = b.node.contents(f), e.length && "BR" == e[e.length - 1].tagName && a(e[e.length - 1]).remove(), a(f).append(a(k).html()), a(k).remove());
                else
                    for (e = b.node.contents(f), e.length && "BR" == e[e.length - 1].tagName && a(e[e.length - 1]).remove(), a(d).replaceWith(a.FE.MARKERS); k && !b.node.isBlock(k) && "BR" != k.tagName;) a(f).append(a(k)), k = k.nextSibling } } return { _startEnter: e, _middleEnter: f, _endEnter: g, _backspace: h, _del: i } }, a.FE.NO_DELETE_TAGS = ["TH", "TD", "TR", "TABLE", "FORM"], a.FE.SIMPLE_ENTER_TAGS = ["TH", "TD", "LI", "DL", "DT", "FORM"], a.FE.MODULES.cursor = function(b) {
        function c(a) { return !!a && (!!b.node.isBlock(a) || (a.nextSibling && a.nextSibling.nodeType == Node.TEXT_NODE && 0 === a.nextSibling.textContent.replace(/\u200b/g, "").length ? c(a.nextSibling) : !(a.nextSibling && (!a.previousSibling || "BR" != a.nextSibling.tagName || a.nextSibling.nextSibling)) && c(a.parentNode))) }

        function d(a) { return !!a && (!!b.node.isBlock(a) || (a.previousSibling && a.previousSibling.nodeType == Node.TEXT_NODE && 0 === a.previousSibling.textContent.replace(/\u200b/g, "").length ? d(a.previousSibling) : !a.previousSibling && (!(a.previousSibling || !b.node.hasClass(a.parentNode, "fr-inner")) || d(a.parentNode)))) }

        function e(a, c) { return !!a && (a != b.$wp.get(0) && (a.previousSibling && a.previousSibling.nodeType == Node.TEXT_NODE && 0 === a.previousSibling.textContent.replace(/\u200b/g, "").length ? e(a.previousSibling, c) : !a.previousSibling && (a.parentNode == c || e(a.parentNode, c)))) }

        function f(a, c) { return !!a && (a != b.$wp.get(0) && (a.nextSibling && a.nextSibling.nodeType == Node.TEXT_NODE && 0 === a.nextSibling.textContent.replace(/\u200b/g, "").length ? f(a.nextSibling, c) : !(a.nextSibling && (!a.previousSibling || "BR" != a.nextSibling.tagName || a.nextSibling.nextSibling)) && (a.parentNode == c || f(a.parentNode, c)))) }

        function g(c) { return a(c).parentsUntil(b.$el, "LI").length > 0 && 0 === a(c).parentsUntil("LI", "TABLE").length }

        function h(a, b) { var c = new RegExp("([\\uD83C-\\uDBFF\\uDC00-\\uDFFF\\u200D]+)" + (b ? "" : "$"), "i"),
                d = a.match(c); return d ? d[0].length : 1 }

        function i(c) { var d = a(c).parentsUntil(b.$el, "BLOCKQUOTE").length > 0,
                e = b.node.deepestParent(c, [], !d); if (e && "BLOCKQUOTE" == e.tagName) { var f = b.node.deepestParent(c, [a(c).parentsUntil(b.$el, "BLOCKQUOTE").get(0)]);
                f && f.previousSibling && (e = f) } if (null !== e) { var g, h = e.previousSibling; if (b.node.isBlock(e) && b.node.isEditable(e) && h && a.FE.NO_DELETE_TAGS.indexOf(h.tagName) < 0)
                    if (b.node.isDeletable(h)) a(h).remove(), a(c).replaceWith(a.FE.MARKERS);
                    else if (b.node.isEditable(h))
                    if (b.node.isBlock(h))
                        if (b.node.isEmpty(h) && !b.node.isList(h)) a(h).remove(), a(c).after(b.opts.keepFormatOnDelete ? a.FE.INVISIBLE_SPACE : "");
                        else { if (b.node.isList(h) && (h = a(h).find("li:last").get(0)), g = b.node.contents(h), g.length && "BR" == g[g.length - 1].tagName && a(g[g.length - 1]).remove(), "BLOCKQUOTE" == h.tagName && "BLOCKQUOTE" != e.tagName)
                                for (g = b.node.contents(h); g.length && b.node.isBlock(g[g.length - 1]);) h = g[g.length - 1], g = b.node.contents(h);
                            else if ("BLOCKQUOTE" != h.tagName && "BLOCKQUOTE" == e.tagName)
                                for (g = b.node.contents(e); g.length && b.node.isBlock(g[0]);) e = g[0], g = b.node.contents(e);
                            b.node.isEmpty(e) ? (a(c).remove(), b.selection.setAtEnd(h, b.opts.keepFormatOnDelete)) : (a(c).replaceWith(a.FE.MARKERS), a(h).append(e.innerHTML)), a(e).remove() } else a(c).replaceWith(a.FE.MARKERS), "BLOCKQUOTE" == e.tagName && h.nodeType == Node.ELEMENT_NODE ? a(h).remove() : (a(h).after(b.node.isEmpty(e) ? "" : a(e).html()), a(e).remove(), "BR" == h.tagName && a(h).remove()) } }

        function j(c) { for (var d = c; !d.previousSibling;)
                if (d = d.parentNode, b.node.isElement(d)) return !1;
            d = d.previousSibling; var e; if (!b.node.isBlock(d) && b.node.isEditable(d)) { for (e = b.node.contents(d); d.nodeType != Node.TEXT_NODE && !b.node.isDeletable(d) && e.length && b.node.isEditable(d);) d = e[e.length - 1], e = b.node.contents(d); if (d.nodeType == Node.TEXT_NODE) { var f = d.textContent,
                        g = f.length; if (b.opts.tabSpaces && f.length >= b.opts.tabSpaces) { var i = f.substr(f.length - b.opts.tabSpaces, f.length - 1);
                        0 === i.replace(/ /g, "").replace(new RegExp(a.FE.UNICODE_NBSP, "g"), "").length && (g = f.length - b.opts.tabSpaces) } d.textContent = f.substring(0, g - h(f)); var j = f.length != d.textContent.length;
                    0 === d.textContent.length ? j && b.opts.keepFormatOnDelete ? a(d).after(a.FE.INVISIBLE_SPACE + a.FE.MARKERS) : (2 != d.parentNode.childNodes.length || d.parentNode != c.parentNode) && 1 != d.parentNode.childNodes.length || b.node.isBlock(d.parentNode) || b.node.isElement(d.parentNode) ? (a(d).after(a.FE.MARKERS), b.node.isElement(d.parentNode) && !c.nextSibling && d.previousSibling && "BR" == d.previousSibling.tagName && a(c).after("<br>"), d.parentNode.removeChild(d)) : (a(d.parentNode).after(a.FE.MARKERS), a(d.parentNode).remove()) : a(d).after(a.FE.MARKERS) } else b.node.isDeletable(d) ? (a(d).after(a.FE.MARKERS), a(d).remove()) : c.nextSibling && "BR" == c.nextSibling.tagName && b.node.isVoid(d) && "BR" != d.tagName ? (a(c.nextSibling).remove(), a(c).replaceWith(a.FE.MARKERS)) : b.events.trigger("node.remove", [a(d)]) !== !1 && (a(d).after(a.FE.MARKERS), a(d).remove()) } else if (a.FE.NO_DELETE_TAGS.indexOf(d.tagName) < 0 && (b.node.isEditable(d) || b.node.isDeletable(d)))
                if (b.node.isDeletable(d)) a(c).replaceWith(a.FE.MARKERS), a(d).remove();
                else if (b.node.isEmpty(d) && !b.node.isList(d)) a(d).remove(), a(c).replaceWith(a.FE.MARKERS);
            else { for (b.node.isList(d) && (d = a(d).find("li:last").get(0)), e = b.node.contents(d), e && "BR" == e[e.length - 1].tagName && a(e[e.length - 1]).remove(), e = b.node.contents(d); e && b.node.isBlock(e[e.length - 1]);) d = e[e.length - 1], e = b.node.contents(d);
                a(d).append(a.FE.MARKERS); for (var k = c; !k.previousSibling;) k = k.parentNode; for (; k && "BR" !== k.tagName && !b.node.isBlock(k);) { var l = k;
                    k = k.nextSibling, a(d).append(l) } k && "BR" == k.tagName && a(k).remove(), a(c).remove() } else c.nextSibling && "BR" == c.nextSibling.tagName && a(c.nextSibling).remove() }

        function k() { var f = !1,
                k = b.markers.insert(); if (!k) return !0; for (var l = k.parentNode; l && !b.node.isElement(l);) { if ("false" === l.getAttribute("contenteditable")) return a(k).replaceWith(a.FE.MARKERS), b.selection.restore(), !1; if ("true" === l.getAttribute("contenteditable")) break;
                l = l.parentNode } b.el.normalize(); var m = k.previousSibling; if (m) { var n = m.textContent;
                n && n.length && 8203 == n.charCodeAt(n.length - 1) && (1 == n.length ? a(m).remove() : m.textContent = m.textContent.substr(0, n.length - h(n))) } return c(k) ? f = j(k) : d(k) ? g(k) && e(k, a(k).parents("li:first").get(0)) ? b.cursorLists._backspace(k) : i(k) : f = j(k), a(k).remove(), o(), b.html.fillEmptyBlocks(!0), b.opts.htmlUntouched || (b.html.cleanEmptyTags(), b.clean.lists()), b.spaces.normalizeAroundCursor(), b.selection.restore(), f }

        function l(c) { var d = a(c).parentsUntil(b.$el, "BLOCKQUOTE").length > 0,
                e = b.node.deepestParent(c, [], !d); if (e && "BLOCKQUOTE" == e.tagName) { var f = b.node.deepestParent(c, [a(c).parentsUntil(b.$el, "BLOCKQUOTE").get(0)]);
                f && f.nextSibling && (e = f) } if (null !== e) { var g, h = e.nextSibling; if (b.node.isBlock(e) && (b.node.isEditable(e) || b.node.isDeletable(e)) && h && a.FE.NO_DELETE_TAGS.indexOf(h.tagName) < 0)
                    if (b.node.isDeletable(h)) a(h).remove(), a(c).replaceWith(a.FE.MARKERS);
                    else if (b.node.isBlock(h) && b.node.isEditable(h))
                    if (b.node.isList(h))
                        if (b.node.isEmpty(e, !0)) a(e).remove(), a(h).find("li:first").prepend(a.FE.MARKERS);
                        else { var i = a(h).find("li:first"); "BLOCKQUOTE" == e.tagName && (g = b.node.contents(e), g.length && b.node.isBlock(g[g.length - 1]) && (e = g[g.length - 1])), 0 === i.find("ul, ol").length && (a(c).replaceWith(a.FE.MARKERS), i.find(b.html.blockTagsQuery()).not("ol, ul, table").each(function() { this.parentNode == i.get(0) && a(this).replaceWith(a(this).html() + (b.node.isEmpty(this) ? "" : "<br>")) }), a(e).append(b.node.contents(i.get(0))), i.remove(), 0 === a(h).find("li").length && a(h).remove()) } else { if (g = b.node.contents(h), g.length && "BR" == g[0].tagName && a(g[0]).remove(), "BLOCKQUOTE" != h.tagName && "BLOCKQUOTE" == e.tagName)
                        for (g = b.node.contents(e); g.length && b.node.isBlock(g[g.length - 1]);) e = g[g.length - 1], g = b.node.contents(e);
                    else if ("BLOCKQUOTE" == h.tagName && "BLOCKQUOTE" != e.tagName)
                        for (g = b.node.contents(h); g.length && b.node.isBlock(g[0]);) h = g[0], g = b.node.contents(h);
                    a(c).replaceWith(a.FE.MARKERS), a(e).append(h.innerHTML), a(h).remove() } else { for (a(c).replaceWith(a.FE.MARKERS); h && "BR" !== h.tagName && !b.node.isBlock(h) && b.node.isEditable(h);) { var j = h;
                        h = h.nextSibling, a(e).append(j) } h && "BR" == h.tagName && b.node.isEditable(h) && a(h).remove() } } }

        function m(d) { for (var e = d; !e.nextSibling;)
                if (e = e.parentNode, b.node.isElement(e)) return !1; if (e = e.nextSibling, "BR" == e.tagName && b.node.isEditable(e))
                if (e.nextSibling) { if (b.node.isBlock(e.nextSibling) && b.node.isEditable(e.nextSibling)) { if (!(a.FE.NO_DELETE_TAGS.indexOf(e.nextSibling.tagName) < 0)) return void a(e).remove();
                        e = e.nextSibling, a(e.previousSibling).remove() } } else if (c(e)) { if (g(d)) b.cursorLists._del(d);
                else { var f = b.node.deepestParent(e);
                    f && ((!b.node.isEmpty(b.node.blockParent(e)) || (b.node.blockParent(e).nextSibling && a.FE.NO_DELETE_TAGS.indexOf(b.node.blockParent(e).nextSibling.tagName)) < 0) && a(e).remove(), l(d)) } return } var i; if (!b.node.isBlock(e) && b.node.isEditable(e)) { for (i = b.node.contents(e); e.nodeType != Node.TEXT_NODE && i.length && !b.node.isDeletable(e) && b.node.isEditable(e);) e = i[0], i = b.node.contents(e);
                e.nodeType == Node.TEXT_NODE ? (a(e).before(a.FE.MARKERS), e.textContent.length && (e.textContent = e.textContent.substring(h(e.textContent, !0), e.textContent.length))) : b.node.isDeletable(e) ? (a(e).before(a.FE.MARKERS), a(e).remove()) : b.events.trigger("node.remove", [a(e)]) !== !1 && (a(e).before(a.FE.MARKERS), a(e).remove()), a(d).remove() } else if (a.FE.NO_DELETE_TAGS.indexOf(e.tagName) < 0 && (b.node.isEditable(e) || b.node.isDeletable(e)))
                if (b.node.isDeletable(e)) a(d).replaceWith(a.FE.MARKERS), a(e).remove();
                else if (b.node.isList(e)) d.previousSibling ? (a(e).find("li:first").prepend(d), b.cursorLists._backspace(d)) : (a(e).find("li:first").prepend(a.FE.MARKERS), a(d).remove());
            else if (i = b.node.contents(e), i && "BR" == i[0].tagName && a(i[0]).remove(), i && "BLOCKQUOTE" == e.tagName) { var j = i[0]; for (a(d).before(a.FE.MARKERS); j && "BR" != j.tagName;) { var k = j;
                    j = j.nextSibling, a(d).before(k) } j && "BR" == j.tagName && a(j).remove() } else a(d).after(a(e).html()).after(a.FE.MARKERS), a(e).remove() }

        function n() { var e = b.markers.insert(); if (!e) return !1; if (b.el.normalize(), c(e))
                if (g(e))
                    if (0 === a(e).parents("li:first").find("ul, ol").length) b.cursorLists._del(e);
                    else { var f = a(e).parents("li:first").find("ul:first, ol:first").find("li:first");
                        f = f.find(b.html.blockTagsQuery()).get(-1) || f, f.prepend(e), b.cursorLists._backspace(e) } else l(e);
            else m(d(e) ? e : e);
            a(e).remove(), o(), b.html.fillEmptyBlocks(!0), b.opts.htmlUntouched || (b.html.cleanEmptyTags(), b.clean.lists()), b.spaces.normalizeAroundCursor(), b.selection.restore() }

        function o() {
            for (var a = b.el.querySelectorAll("blockquote:empty"), c = 0; c < a.length; c++) a[c].parentNode.removeChild(a[c]);
        }

        function p() { b.$el.find(".fr-to-remove").each(function() { for (var c = b.node.contents(this), d = 0; d < c.length; d++) c[d].nodeType == Node.TEXT_NODE && (c[d].textContent = c[d].textContent.replace(/\u200B/g, ""));
                a(this).replaceWith(this.innerHTML) }) }

        function q(c, d, e) { var g, h = b.node.deepestParent(c, [], !e); if (h && "BLOCKQUOTE" == h.tagName) return f(c, h) ? (g = b.html.defaultTag(), g ? a(h).after("<" + g + ">" + a.FE.MARKERS + "<br></" + g + ">") : a(h).after(a.FE.MARKERS + "<br>"), a(c).remove(), !1) : (s(c, d, e), !1); if (null == h) g = b.html.defaultTag(), g && b.node.isElement(c.parentNode) ? a(c).replaceWith("<" + g + ">" + a.FE.MARKERS + "<br></" + g + ">") : !c.previousSibling || a(c.previousSibling).is("br") || c.nextSibling ? a(c).replaceWith("<br>" + a.FE.MARKERS) : a(c).replaceWith("<br>" + a.FE.MARKERS + "<br>");
            else { var i = c,
                    j = "";
                b.node.isBlock(h) && !d || (j = "<br/>"); var k = "",
                    l = "";
                g = b.html.defaultTag(); var m = "",
                    n = "";
                g && b.node.isBlock(h) && (m = "<" + g + ">", n = "</" + g + ">", h.tagName == g.toUpperCase() && (m = b.node.openTagString(a(h).clone().removeAttr("id").get(0))));
                do
                    if (i = i.parentNode, !d || i != h || d && !b.node.isBlock(h))
                        if (k += b.node.closeTagString(i), i == h && b.node.isBlock(h)) l = m + l;
                        else { var o = "A" == i.tagName && f(c, i) ? "fr-to-remove" : "";
                            l = b.node.openTagString(a(i).clone().addClass(o).get(0)) + l } while (i != h);
                j = k + j + l + (c.parentNode == h && b.node.isBlock(h) ? "" : a.FE.INVISIBLE_SPACE) + a.FE.MARKERS, b.node.isBlock(h) && !a(h).find("*:last").is("br") && a(h).append("<br/>"), a(c).after('<span id="fr-break"></span>'), a(c).remove(), h.nextSibling && !b.node.isBlock(h.nextSibling) || b.node.isBlock(h) || a(h).after("<br>"); var p;
                p = !d && b.node.isBlock(h) ? b.node.openTagString(h) + a(h).html() + n : b.node.openTagString(h) + a(h).html() + b.node.closeTagString(h), p = p.replace(/<span id="fr-break"><\/span>/g, j), a(h).replaceWith(p) } }

        function r(c, d, g) { var h, i = b.node.deepestParent(c, [], !g); if (i && "TABLE" == i.tagName) return a(i).find("td:first, th:first").prepend(c), r(c, d, g); if (i && "BLOCKQUOTE" == i.tagName) { if (e(c, i)) return h = b.html.defaultTag(), h ? a(i).before("<" + h + ">" + a.FE.MARKERS + "<br></" + h + ">") : a(i).before(a.FE.MARKERS + "<br>"), a(c).remove(), !1;
                f(c, i) ? q(c, d, !0) : s(c, d, !0) } if (null == i) h = b.html.defaultTag(), h && b.node.isElement(c.parentNode) ? a(c).replaceWith("<" + h + ">" + a.FE.MARKERS + "<br></" + h + ">") : a(c).replaceWith("<br>" + a.FE.MARKERS);
            else { if (b.node.isBlock(i))
                    if ("PRE" == i.tagName && (d = !0), d) a(c).remove(), a(i).prepend("<br>" + a.FE.MARKERS);
                    else { if (b.node.isEmpty(i, !0)) return q(c, d, g); if (b.opts.keepFormatOnDelete) { for (var j = c, k = a.FE.INVISIBLE_SPACE; j != i && !b.node.isElement(j);) j = j.parentNode, k = b.node.openTagString(j) + k + b.node.closeTagString(j);
                            a(i).before(k) } else a(i).before(b.node.openTagString(a(i).clone().removeAttr("id").get(0)) + "<br>" + b.node.closeTagString(i)) } else a(i).before("<br>");
                a(c).remove() } }

        function s(c, d, g) { var h = b.node.deepestParent(c, [], !g); if (null == h) b.html.defaultTag() && c.parentNode === b.el ? a(c).replaceWith("<" + b.html.defaultTag() + ">" + a.FE.MARKERS + "<br></" + b.html.defaultTag() + ">") : (c.nextSibling && !b.node.isBlock(c.nextSibling) || a(c).after("<br>"), a(c).replaceWith("<br>" + a.FE.MARKERS));
            else { var i = c,
                    j = ""; "PRE" == h.tagName && (d = !0), b.node.isBlock(h) && !d || (j = "<br>"); var k = "",
                    l = "";
                do { var m = i; if (i = i.parentNode, "BLOCKQUOTE" == h.tagName && b.node.isEmpty(m) && !b.node.hasClass(m, "fr-marker") && a(m).find(c).length > 0 && a(m).after(c), ("BLOCKQUOTE" != h.tagName || !f(c, i) && !e(c, i)) && (!d || i != h || d && !b.node.isBlock(h))) { k += b.node.closeTagString(i); var n = "A" == i.tagName && f(c, i) ? "fr-to-remove" : "";
                        l = b.node.openTagString(a(i).clone().addClass(n).removeAttr("id").get(0)) + l } } while (i != h); var o = h == c.parentNode && b.node.isBlock(h) || c.nextSibling; if ("BLOCKQUOTE" == h.tagName) { c.previousSibling && b.node.isBlock(c.previousSibling) && c.nextSibling && "BR" == c.nextSibling.tagName && (a(c.nextSibling).after(c), c.nextSibling && "BR" == c.nextSibling.tagName && a(c.nextSibling).remove()); var p = b.html.defaultTag();
                    j = k + j + (p ? "<" + p + ">" : "") + a.FE.MARKERS + "<br>" + (p ? "</" + p + ">" : "") + l } else j = k + j + l + (o ? "" : a.FE.INVISIBLE_SPACE) + a.FE.MARKERS;
                a(c).replaceWith('<span id="fr-break"></span>'); var q = b.node.openTagString(h) + a(h).html() + b.node.closeTagString(h);
                q = q.replace(/<span id="fr-break"><\/span>/g, j), a(h).replaceWith(q) } }

        function t(e) { var f = b.markers.insert(); if (!f) return !0;
            b.el.normalize(); var h = !1;
            a(f).parentsUntil(b.$el, "BLOCKQUOTE").length > 0 && (e = !1, h = !0), a(f).parentsUntil(b.$el, "TD, TH").length && (h = !1), c(f) ? !g(f) || e || h ? q(f, e, h) : b.cursorLists._endEnter(f) : d(f) ? !g(f) || e || h ? r(f, e, h) : b.cursorLists._startEnter(f) : !g(f) || e || h ? s(f, e, h) : b.cursorLists._middleEnter(f), p(), b.html.fillEmptyBlocks(!0), b.opts.htmlUntouched || (b.html.cleanEmptyTags(), b.clean.lists()), b.spaces.normalizeAroundCursor(), b.selection.restore() }
        return { enter: t, backspace: k, del: n, isAtEnd: f, isAtStart: e }
    }, a.FE.ENTER_P = 0, a.FE.ENTER_DIV = 1, a.FE.ENTER_BR = 2, a.FE.KEYCODE = { BACKSPACE: 8, TAB: 9, ENTER: 13, SHIFT: 16, CTRL: 17, ALT: 18, ESC: 27, SPACE: 32, ARROW_LEFT: 37, ARROW_UP: 38, ARROW_RIGHT: 39, ARROW_DOWN: 40, DELETE: 46, ZERO: 48, ONE: 49, TWO: 50, THREE: 51, FOUR: 52, FIVE: 53, SIX: 54, SEVEN: 55, EIGHT: 56, NINE: 57, FF_SEMICOLON: 59, FF_EQUALS: 61, QUESTION_MARK: 63, A: 65, B: 66, C: 67, D: 68, E: 69, F: 70, G: 71, H: 72, I: 73, J: 74, K: 75, L: 76, M: 77, N: 78, O: 79, P: 80, Q: 81, R: 82, S: 83, T: 84, U: 85, V: 86, W: 87, X: 88, Y: 89, Z: 90, META: 91, NUM_ZERO: 96, NUM_ONE: 97, NUM_TWO: 98, NUM_THREE: 99, NUM_FOUR: 100, NUM_FIVE: 101, NUM_SIX: 102, NUM_SEVEN: 103, NUM_EIGHT: 104, NUM_NINE: 105, NUM_MULTIPLY: 106, NUM_PLUS: 107, NUM_MINUS: 109, NUM_PERIOD: 110, NUM_DIVISION: 111, F1: 112, F2: 113, F3: 114, F4: 115, F5: 116, F6: 117, F7: 118, F8: 119, F9: 120, F10: 121, F11: 122, F12: 123, FF_HYPHEN: 173, SEMICOLON: 186, DASH: 189, EQUALS: 187, COMMA: 188, HYPHEN: 189, PERIOD: 190, SLASH: 191, APOSTROPHE: 192, TILDE: 192, SINGLE_QUOTE: 222, OPEN_SQUARE_BRACKET: 219, BACKSLASH: 220, CLOSE_SQUARE_BRACKET: 221, IME: 229 }, a.extend(a.FE.DEFAULTS, { enter: a.FE.ENTER_P, multiLine: !0, tabSpaces: 0 }), a.FE.MODULES.keys = function(b) {
        function c(a) { b.opts.multiLine ? b.helpers.isIOS() ? I = b.snapshot.get() : (a.preventDefault(), a.stopPropagation(), b.selection.isCollapsed() || b.selection.remove(), b.cursor.enter()) : (a.preventDefault(), a.stopPropagation()) }

        function d(a) { a.preventDefault(), a.stopPropagation(), b.opts.multiLine && (b.selection.isCollapsed() || b.selection.remove(), b.cursor.enter(!0)) }

        function e() { setTimeout(function() { b.events.disableBlur(), b.events.focus() }, 0) }

        function f(a) { b.selection.isCollapsed() ? b.helpers.isIOS() ? I = b.snapshot.get() : (b.cursor.backspace(), a.preventDefault(), a.stopPropagation()) : (a.preventDefault(), a.stopPropagation(), b.selection.remove(), b.html.fillEmptyBlocks()), b.placeholder.refresh() }

        function g(a) { a.preventDefault(), a.stopPropagation(), "" === b.selection.text() ? b.cursor.del() : b.selection.remove(), b.placeholder.refresh() }

        function h(c) { var d = b.selection.element(); if (!b.helpers.isMobile() && d && "A" == d.tagName) { c.preventDefault(), c.stopPropagation(), b.selection.isCollapsed() || b.selection.remove(); var e = b.markers.insert(); if (e) { var f = e.previousSibling,
                        g = e.nextSibling;!g && e.parentNode && "A" == e.parentNode.tagName ? (e.parentNode.insertAdjacentHTML("afterend", "&nbsp;" + a.FE.MARKERS), e.parentNode.removeChild(e)) : (f && f.nodeType == Node.TEXT_NODE && 1 == f.textContent.length && 160 == f.textContent.charCodeAt(0) ? f.textContent = f.textContent + " " : e.insertAdjacentHTML("beforebegin", "&nbsp;"), e.outerHTML = a.FE.MARKERS), b.selection.restore() } } }

        function i() { if (b.browser.mozilla && b.selection.isCollapsed() && !H) { var a = b.selection.ranges(0),
                    c = a.startContainer,
                    d = a.startOffset;
                c && c.nodeType == Node.TEXT_NODE && d <= c.textContent.length && d > 0 && 32 == c.textContent.charCodeAt(d - 1) && (b.selection.save(), b.spaces.normalize(), b.selection.restore()) } }

        function j() { b.selection.isFull() && setTimeout(function() { var c = b.html.defaultTag();
                c ? b.$el.html("<" + c + ">" + a.FE.MARKERS + "<br/></" + c + ">") : b.$el.html(a.FE.MARKERS + "<br/>"), b.selection.restore(), b.placeholder.refresh(), b.button.bulkRefresh(), b.undo.saveStep() }, 0) }

        function k(a) { if (b.opts.tabSpaces > 0)
                if (b.selection.isCollapsed()) { b.undo.saveStep(), a.preventDefault(), a.stopPropagation(); for (var c = "", d = 0; d < b.opts.tabSpaces; d++) c += "&nbsp;";
                    b.html.insert(c), b.placeholder.refresh(), b.undo.saveStep() } else a.preventDefault(), a.stopPropagation(), a.shiftKey ? b.commands.outdent() : b.commands.indent() }

        function l() { H = !1 }

        function m() { H = !1 }

        function n() { return H }

        function o() { var c = b.html.defaultTag();
            c ? b.$el.html("<" + c + ">" + a.FE.MARKERS + "<br/></" + c + ">") : b.$el.html(a.FE.MARKERS + "<br/>"), b.selection.restore() }

        function p(i) { b.events.disableBlur(), I = null; var j = i.which; if (16 === j) return !0; if (E = j, j === a.FE.KEYCODE.IME) return H = !0, !0;
            H = !1; var l = w(j) && !u(i),
                m = j == a.FE.KEYCODE.BACKSPACE || j == a.FE.KEYCODE.DELETE; return (b.selection.isFull() && !b.opts.keepFormatOnDelete && !b.placeholder.isVisible() || m && b.placeholder.isVisible() && b.opts.keepFormatOnDelete) && (l || m) && (o(), !w(j)) ? (i.preventDefault(), !0) : (j == a.FE.KEYCODE.ENTER ? i.shiftKey ? d(i) : c(i) : j === a.FE.KEYCODE.BACKSPACE && (i.metaKey || i.ctrlKey) ? e() : j != a.FE.KEYCODE.BACKSPACE || u(i) || i.altKey ? j != a.FE.KEYCODE.DELETE || u(i) || i.altKey || i.shiftKey ? j == a.FE.KEYCODE.SPACE ? h(i) : j == a.FE.KEYCODE.TAB ? k(i) : u(i) || !w(i.which) || b.selection.isCollapsed() || i.ctrlKey || b.selection.remove() : b.placeholder.isVisible() ? (b.opts.keepFormatOnDelete || o(), i.preventDefault(), i.stopPropagation()) : g(i) : b.placeholder.isVisible() ? (b.opts.keepFormatOnDelete || o(), i.preventDefault(), i.stopPropagation()) : f(i), void b.events.enableBlur()) }

        function q(a) { for (var c = b.doc.createTreeWalker(a, NodeFilter.SHOW_TEXT, b.node.filter(function(a) { return /\u200B/gi.test(a.textContent) }), !1); c.nextNode();) { var d = c.currentNode;
                d.textContent = d.textContent.replace(/\u200B/gi, "") } }

        function r() { if (!b.$wp) return !0; var c;
            b.opts.height || b.opts.heightMax ? (c = b.position.getBoundingRect().top, (b.helpers.isIOS() || b.helpers.isAndroid()) && (c -= b.helpers.scrollTop()), b.opts.iframe && (c += b.$iframe.offset().top), c > b.$wp.offset().top - b.helpers.scrollTop() + b.$wp.height() - 20 && b.$wp.scrollTop(c + b.$wp.scrollTop() - (b.$wp.height() + b.$wp.offset().top) + b.helpers.scrollTop() + 20)) : (c = b.position.getBoundingRect().top, b.opts.toolbarBottom && (c += b.opts.toolbarStickyOffset), (b.helpers.isIOS() || b.helpers.isAndroid()) && (c -= b.helpers.scrollTop()), b.opts.iframe && (c += b.$iframe.offset().top, c -= b.helpers.scrollTop()), c += b.opts.toolbarStickyOffset, c > b.o_win.innerHeight - 20 && a(b.o_win).scrollTop(c + b.helpers.scrollTop() - b.o_win.innerHeight + 20), c = b.position.getBoundingRect().top, b.opts.toolbarBottom || (c -= b.opts.toolbarStickyOffset), (b.helpers.isIOS() || b.helpers.isAndroid()) && (c -= b.helpers.scrollTop()), b.opts.iframe && (c += b.$iframe.offset().top, c -= b.helpers.scrollTop()), c < b.$tb.height() + 20 && c >= 0 && a(b.o_win).scrollTop(c + b.helpers.scrollTop() - b.$tb.height() - 20)) }

        function s() { var c = b.selection.element(),
                d = b.node.blockParent(c); if (d && "DIV" == d.tagName && b.selection.info(d).atStart) { var e = b.html.defaultTag();
                d.previousSibling && "DIV" != d.previousSibling.tagName && e && "div" != e && (b.selection.save(), a(d).replaceWith("<" + e + ">" + d.innerHTML + "</" + e + ">"), b.selection.restore()) } }

        function t(c) { if (c && 0 === c.which && E && (c.which = E), b.helpers.isIOS() && c && I)
                if (c.which == a.FE.KEYCODE.ENTER) b.snapshot.restore(I), b.cursor.enter();
                else if (c.which == a.FE.KEYCODE.BACKSPACE) { var d = b.snapshot.get();
                b.snapshot.restore(I), b.cursor.backspace(), b.el.innerHTML !== d.html && b.snapshot.restore(d) } if (b.helpers.isAndroid() && b.browser.mozilla) return !0; if (H) return !1; if (!b.selection.isCollapsed()) return !0; if (c && (c.which === a.FE.KEYCODE.META || c.which == a.FE.KEYCODE.CTRL)) return !0; if (c && v(c.which)) return !0;
            c && c.which == a.FE.KEYCODE.ENTER && b.helpers.isIOS() && s(), c && (c.which == a.FE.KEYCODE.ENTER || c.which == a.FE.KEYCODE.BACKSPACE || c.which >= 37 && c.which <= 40 && !b.browser.msie) && r(); var e = function(a) { if (!a) return !1; var b = a.innerHTML; return b = b.replace(/<span[^>]*? class\s*=\s*["']?fr-marker["']?[^>]+>\u200b<\/span>/gi, ""), !!(b && /\u200B/.test(b) && b.replace(/\u200B/gi, "").length > 0) },
                f = function(a) { var c = /[\u3041-\u3096\u30A0-\u30FF\u4E00-\u9FFF\u3130-\u318F\uAC00-\uD7AF]/gi; return !b.helpers.isIOS() || 0 === ((a.textContent || "").match(c) || []).length },
                g = b.selection.element();
            e(g) && !b.node.hasClass(g, "fr-marker") && "IFRAME" != g.tagName && f(g) && (b.selection.save(), q(g), b.selection.restore()) }

        function u(a) { if (navigator.userAgent.indexOf("Mac OS X") != -1) { if (a.metaKey && !a.altKey) return !0 } else if (a.ctrlKey && !a.altKey) return !0; return !1 }

        function v(b) { if (b >= a.FE.KEYCODE.ARROW_LEFT && b <= a.FE.KEYCODE.ARROW_DOWN) return !0 }

        function w(c) { if (c >= a.FE.KEYCODE.ZERO && c <= a.FE.KEYCODE.NINE) return !0; if (c >= a.FE.KEYCODE.NUM_ZERO && c <= a.FE.KEYCODE.NUM_MULTIPLY) return !0; if (c >= a.FE.KEYCODE.A && c <= a.FE.KEYCODE.Z) return !0; if (b.browser.webkit && 0 === c) return !0; switch (c) {
                case a.FE.KEYCODE.SPACE:
                case a.FE.KEYCODE.QUESTION_MARK:
                case a.FE.KEYCODE.NUM_PLUS:
                case a.FE.KEYCODE.NUM_MINUS:
                case a.FE.KEYCODE.NUM_PERIOD:
                case a.FE.KEYCODE.NUM_DIVISION:
                case a.FE.KEYCODE.SEMICOLON:
                case a.FE.KEYCODE.FF_SEMICOLON:
                case a.FE.KEYCODE.DASH:
                case a.FE.KEYCODE.EQUALS:
                case a.FE.KEYCODE.FF_EQUALS:
                case a.FE.KEYCODE.COMMA:
                case a.FE.KEYCODE.PERIOD:
                case a.FE.KEYCODE.SLASH:
                case a.FE.KEYCODE.APOSTROPHE:
                case a.FE.KEYCODE.SINGLE_QUOTE:
                case a.FE.KEYCODE.OPEN_SQUARE_BRACKET:
                case a.FE.KEYCODE.BACKSLASH:
                case a.FE.KEYCODE.CLOSE_SQUARE_BRACKET:
                    return !0;
                default:
                    return !1 } }

        function x(c) { var d = c.which; return !!(u(c) || d >= 37 && d <= 40 || !w(d) && d != a.FE.KEYCODE.DELETE && d != a.FE.KEYCODE.BACKSPACE && d != a.FE.KEYCODE.ENTER && d != a.FE.KEYCODE.IME) || (F || (G = b.snapshot.get(), b.undo.canDo() || b.undo.saveStep()), clearTimeout(F), void(F = setTimeout(function() { F = null, b.undo.saveStep() }, Math.max(250, b.opts.typingTimer)))) }

        function y(a) { var c = a.which; return !!(u(a) || c >= 37 && c <= 40) || void(G && F ? (b.undo.saveStep(G), G = null) : "undefined" != typeof c && 0 !== c || G || F || b.undo.saveStep()) }

        function z() { F && (clearTimeout(F), b.undo.saveStep(), G = null) }

        function A(b) { var c = b.which; return u(b) || c == a.FE.KEYCODE.F5 }

        function B(a) { return (!a || "BR" != a.tagName) && (0 === (a.textContent || "").length && a.querySelector && !a.querySelector(":scope > br")) }

        function C(c) { var d = b.el.childNodes,
                e = b.html.defaultTag(); return !(!c.target || c.target === b.el) || (0 === d.length || void(b.$el.outerHeight() - c.offsetY <= 10 ? B(d[d.length - 1]) && (e ? b.$el.append("<" + e + ">" + a.FE.MARKERS + "<br></" + e + ">") : b.$el.append(a.FE.MARKERS + "<br>"), b.selection.restore(), r()) : c.offsetY <= 10 && B(d[0]) && (e ? b.$el.prepend("<" + e + ">" + a.FE.MARKERS + "<br></" + e + ">") : b.$el.prepend(a.FE.MARKERS + "<br>"), b.selection.restore(), r()))) }

        function D() { if (b.events.on("keydown", x), b.events.on("input", i), b.events.on("mousedown", m), b.events.on("keyup input", y), b.events.on("keypress", l), b.events.on("keydown", p), b.events.on("keyup", t), b.events.on("html.inserted", t), b.events.on("cut", j), b.events.on("click", C), !b.browser.edge && b.el.msGetInputContext) try { b.el.msGetInputContext().addEventListener("MSCandidateWindowShow", function() { H = !0 }), b.el.msGetInputContext().addEventListener("MSCandidateWindowHide", function() { H = !1, t() }) } catch (a) {} } var E, F, G, H = !1,
            I = null; return { _init: D, ctrlKey: u, isCharacter: w, isArrow: v, forceUndo: z, isIME: n, isBrowserAction: A, positionCaret: r } }, a.FE.MODULES.accessibility = function(b) {
        function c(a) { if (a && a.length) { a.data("blur-event-set") || a.parents(".fr-popup").length || (b.events.$on(a, "blur", function() { var c = a.parents(".fr-toolbar, .fr-popup").data("instance") || b;
                    c.events.blurActive() && c.events.trigger("blur"), c.events.enableBlur() }, !0), a.data("blur-event-set", !0)); var c = a.parents(".fr-toolbar, .fr-popup").data("instance") || b;
                c.events.disableBlur(), a.focus(), b.shared.$f_el = a } }

        function d(a, b) { var d = b ? "last" : "first",
                e = a.find("button:visible:not(.fr-disabled), .fr-group span.fr-command:visible")[d](); if (e.length) return c(e), !0 }

        function e(a) { return a.is("input, textarea") && g(), b.events.disableBlur(), a.focus(), !0 }

        function f(a, c) { var d = a.find("input, textarea, button, select").filter(":visible").not(":disabled").filter(c ? ":last" : ":first"); if (d.length) return e(d); if (b.shared.with_kb) { var f = a.find(".fr-active-item:visible:first"); if (f.length) return e(f); var g = a.find("[tabIndex]:visible:first"); if (g.length) return e(g) } }

        function g() { 0 === b.$el.find(".fr-marker").length && b.core.hasFocus() && b.selection.save() }

        function h(a) { a.$el.find(".fr-marker").length && (a.events.disableBlur(), a.selection.restore(), a.events.enableBlur()) }

        function i(a) { var c = a.children().not(".fr-buttons");
            c.data("mouseenter-event-set") || (b.events.$on(c, "mouseenter", "[tabIndex]", function(d) { var e = a.data("instance") || b; if (!F) return d.stopPropagation(), void d.preventDefault(); var f = c.find(":focus:first");
                f.length && !f.is("input, button, textarea") && (e.events.disableBlur(), f.blur(), e.events.disableBlur(), e.events.focus()) }), c.data("mouseenter-event-set", !0)), !f(c) && b.shared.with_kb && d(a.find(".fr-buttons")) }

        function j(a) { b.core.hasFocus() || (b.events.disableBlur(), b.events.focus()), b.accessibility.saveSelection(), b.events.disableBlur(), b.$el.blur(), b.selection.clear(), b.events.disableBlur(), b.shared.with_kb ? a.find(".fr-command[tabIndex], [tabIndex]").first().focus() : a.find("[tabIndex]:first").focus() }

        function k() { var a = b.popups.areVisible(); if (a) { var c = a.find(".fr-buttons"); return c.find("button:focus, .fr-group span:focus").length ? !d(a.data("instance").$tb) : !d(c) } return !d(b.$tb) }

        function l() { var a = null; return b.shared.$f_el.is(".fr-dropdown.fr-active") ? a = b.shared.$f_el : b.shared.$f_el.closest(".fr-dropdown-menu").prev().is(".fr-dropdown.fr-active") && (a = b.shared.$f_el.closest(".fr-dropdown-menu").prev()), a }

        function m(e, g, h) { if (b.shared.$f_el) { var i = l();
                i && (b.button.click(i), b.shared.$f_el = i); var j = e.find("button:visible:not(.fr-disabled), .fr-group span.fr-command:visible"),
                    k = j.index(b.shared.$f_el); if (0 === k && !h || k == j.length - 1 && h) { var m; if (g) { if (e.parent().is(".fr-popup")) { var n = e.parent().children().not(".fr-buttons");
                            m = !f(n, !h) } m === !1 && (b.shared.$f_el = null) } g && m === !1 || d(e, !h) } else c(a(j.get(k + (h ? 1 : -1)))); return !1 } }

        function n(a, b) { return m(a, b, !0) }

        function o(a, b) { return m(a, b) }

        function p(a) { if (b.shared.$f_el) { var d; if (b.shared.$f_el.is(".fr-dropdown.fr-active")) return d = a ? b.shared.$f_el.next().find(".fr-command:not(.fr-disabled)").first() : b.shared.$f_el.next().find(".fr-command:not(.fr-disabled)").last(), c(d), !1; if (b.shared.$f_el.is("a.fr-command")) return d = a ? b.shared.$f_el.closest("li").nextAll(":visible:first").find(".fr-command:not(.fr-disabled)").first() : b.shared.$f_el.closest("li").prevAll(":visible:first").find(".fr-command:not(.fr-disabled)").first(), d.length || (d = a ? b.shared.$f_el.closest(".fr-dropdown-menu").find(".fr-command:not(.fr-disabled)").first() : b.shared.$f_el.closest(".fr-dropdown-menu").find(".fr-command:not(.fr-disabled)").last()), c(d), !1 } }

        function q() { return b.shared.$f_el && b.shared.$f_el.is(".fr-dropdown:not(.fr-active)") ? s() : p(!0) }

        function r() { return p() }

        function s() { if (b.shared.$f_el) { if (b.shared.$f_el.hasClass("fr-dropdown")) b.button.click(b.shared.$f_el);
                else if (b.shared.$f_el.is("button.fr-back")) { b.opts.toolbarInline && (b.events.disableBlur(), b.events.focus()); var a = b.popups.areVisible(b);
                    a && (b.shared.with_kb = !1), b.button.click(b.shared.$f_el), z(a) } else { if (b.events.disableBlur(), b.button.click(b.shared.$f_el), b.shared.$f_el.attr("data-popup")) { var c = b.popups.areVisible(b);
                        c && c.data("popup-button", b.shared.$f_el) } else if (b.shared.$f_el.attr("data-modal")) { var d = b.modals.areVisible(b);
                        d && d.data("modal-button", b.shared.$f_el) } b.shared.$f_el = null } return !1 } }

        function t() { b.shared.$f_el && (b.events.disableBlur(), b.shared.$f_el.blur(), b.shared.$f_el = null), b.events.trigger("toolbar.focusEditor") !== !1 && (b.events.disableBlur(), b.$el.focus(), b.events.focus()) }

        function u(a) { if (b.shared.$f_el) { var d = l(); return d ? (b.button.click(d), c(d)) : a.parent().find(".fr-back:visible").length ? (b.shared.with_kb = !1, b.opts.toolbarInline && (b.events.disableBlur(), b.events.focus()), b.button.exec(a.parent().find(".fr-back:visible:first")), z(a.parent())) : b.shared.$f_el.is("button, .fr-group span") && (a.parent().is(".fr-popup") ? (h(b), b.shared.$f_el = null, b.events.trigger("toolbar.esc") !== !1 && (b.popups.hide(a.parent()), b.opts.toolbarInline && b.toolbar.showInline(null, !0), z(a.parent()))) : t()), !1 } }

        function v(c, d) { var e = navigator.userAgent.indexOf("Mac OS X") != -1 ? c.metaKey : c.ctrlKey,
                f = c.which,
                g = !1; return f != a.FE.KEYCODE.TAB || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ARROW_RIGHT || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.TAB || e || !c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ARROW_LEFT || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ARROW_UP || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ARROW_DOWN || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ENTER || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.ESC || e || c.shiftKey || c.altKey ? f != a.FE.KEYCODE.F10 || e || c.shiftKey || !c.altKey || (g = k()) : g = u(d) : g = s() : g = q() : g = r() : g = o(d) : g = o(d, !0) : g = n(d) : g = n(d, !0), b.shared.$f_el || void 0 !== g || (g = !0), !g && b.keys.isBrowserAction(c) && (g = !0), !!g || (c.preventDefault(), c.stopPropagation(), !1) }

        function w(c) { c && c.length && (b.events.$on(c, "keydown", function(d) { if (!a(d.target).is("a.fr-command, button.fr-command, .fr-group span.fr-command")) return !0; var e = c.parents(".fr-popup").data("instance") || c.data("instance") || b;
                b.shared.with_kb = !0; var f = e.accessibility.exec(d, c); return b.shared.with_kb = !1, f }, !0), b.events.$on(c, "mouseenter", "[tabIndex]", function(d) { var e = c.parents(".fr-popup").data("instance") || c.data("instance") || b; if (!F) return d.stopPropagation(), void d.preventDefault(); var f = a(d.currentTarget);
                e.shared.$f_el && e.shared.$f_el.not(f) && e.accessibility.focusEditor() }, !0)) }

        function x(a) { var c = b.popups.get(a),
                d = y(a);
            w(c.find(".fr-buttons")), b.events.$on(c, "mouseenter", "tabIndex", d._tiMouseenter, !0), b.events.$on(c.children().not(".fr-buttons"), "keydown", "[tabIndex]", d._tiKeydown, !0), b.popups.onHide(a, function() { h(c.data("instance") || b) }), b.popups.onShow(a, function() { F = !1, setTimeout(function() { F = !0 }, 0) }) }

        function y(c) { var e = b.popups.get(c); return { _tiKeydown: function(g) { var i = e.data("instance") || b; if (i.events.trigger("popup.tab", [g]) === !1) return !1; var j = g.which,
                        k = e.find(":focus:first"); if (a.FE.KEYCODE.TAB == j) { g.preventDefault(); var l = e.children().not(".fr-buttons"),
                            m = l.find("input, textarea, button, select").filter(":visible").not(".fr-no-touch input, .fr-no-touch textarea, .fr-no-touch button, .fr-no-touch select, :disabled").toArray(),
                            n = m.indexOf(this) + (g.shiftKey ? -1 : 1); if (0 <= n && n < m.length) return i.events.disableBlur(), a(m[n]).focus(), g.stopPropagation(), !1; var o = e.find(".fr-buttons"); if (o.length && d(o, !!g.shiftKey)) return g.stopPropagation(), !1; if (f(l)) return g.stopPropagation(), !1 } else { if (a.FE.KEYCODE.ENTER != j) return a.FE.KEYCODE.ESC == j ? (g.preventDefault(), g.stopPropagation(), h(i), i.popups.isVisible(c) && e.find(".fr-back:visible").length ? (i.opts.toolbarInline && (i.events.disableBlur(), i.events.focus()), i.button.exec(e.find(".fr-back:visible:first")), z(e)) : i.popups.isVisible(c) && e.find(".fr-dismiss:visible").length ? i.button.exec(e.find(".fr-dismiss:visible:first")) : (i.popups.hide(c), i.opts.toolbarInline && i.toolbar.showInline(null, !0), z(e)), !1) : a.FE.KEYCODE.SPACE == j && (k.is(".fr-submit") || k.is(".fr-dismiss")) ? (g.preventDefault(), g.stopPropagation(), i.events.disableBlur(), i.button.exec(k), !0) : i.keys.isBrowserAction(g) ? void g.stopPropagation() : k.is("input[type=text], textarea") ? void g.stopPropagation() : a.FE.KEYCODE.SPACE == j && (k.is(".fr-link-attr") || k.is("input[type=file]")) ? void g.stopPropagation() : (g.stopPropagation(), g.preventDefault(), !1); var p = null;
                        e.find(".fr-submit:visible").length > 0 ? p = e.find(".fr-submit:visible:first") : e.find(".fr-dismiss:visible").length && (p = e.find(".fr-dismiss:visible:first")), p && (g.preventDefault(), g.stopPropagation(), i.events.disableBlur(), i.button.exec(p)) } }, _tiMouseenter: function() { var a = e.data("instance") || b;
                    C(a) } } }

        function z(a) { var b = a.data("popup-button");
            b && setTimeout(function() { c(b), a.data("popup-button", null) }, 0) }

        function A(a) { var b = a.data("modal-button");
            b && setTimeout(function() { c(b), a.data("modal-button", null) }, 0) }

        function B() { return null != b.shared.$f_el }

        function C(a) { var c = b.popups.areVisible(a);
            c && c.data("popup-button", null) }

        function D(c) { var d = navigator.userAgent.indexOf("Mac OS X") != -1 ? c.metaKey : c.ctrlKey,
                e = c.which; if (e == a.FE.KEYCODE.F10 && !d && !c.shiftKey && c.altKey) { b.shared.with_kb = !0; var g = b.popups.areVisible(b),
                    h = !1; return g && (h = f(g.children().not(".fr-buttons"))), h || k(), b.shared.with_kb = !1, c.preventDefault(), c.stopPropagation(), !1 } return !0 }

        function E() { b.$wp ? b.events.on("keydown", D, !0) : b.events.$on(b.$win, "keydown", D, !0), b.events.on("mousedown", function(a) { C(b), b.shared.$f_el && (h(b), a.stopPropagation(), b.events.disableBlur(), b.shared.$f_el = null) }, !0), b.events.on("blur", function() { b.shared.$f_el = null, C(b) }, !0) } var F = !0; return { _init: E, registerPopup: x, registerToolbar: w, focusToolbarElement: c, focusToolbar: d, focusContent: f, focusPopup: i, focusModal: j, focusEditor: t, focusPopupButton: z, focusModalButton: A, hasFocus: B, exec: v, saveSelection: g, restoreSelection: h } }, a.FE.MODULES.format = function(b) {
        function c(a, b) { var c = "<" + a; for (var d in b) b.hasOwnProperty(d) && (c += " " + d + '="' + b[d] + '"'); return c += ">" }

        function d(a) { return "</" + a + ">" }

        function e(a, b) { var c = a; for (var d in b) b.hasOwnProperty(d) && (c += "id" == d ? "#" + b[d] : "class" == d ? "." + b[d] : "[" + d + '="' + b[d] + '"]'); return c }

        function f(a, b) { return !(!a || a.nodeType != Node.ELEMENT_NODE) && (a.matches || a.matchesSelector || a.msMatchesSelector || a.mozMatchesSelector || a.webkitMatchesSelector || a.oMatchesSelector).call(a, b) }

        function g(d, e, f) { if (d) { if (b.node.isBlock(d)) return g(d.firstChild, e, f), !1; for (var h = a(c(e, f)).insertBefore(d), i = d; i && !a(i).is(".fr-marker") && 0 === a(i).find(".fr-marker").length && "UL" != i.tagName && "OL" != i.tagName;) { var j = i;
                    i = i.nextSibling, h.append(j) } if (i)(a(i).find(".fr-marker").length || "UL" == i.tagName || "OL" == i.tagName) && g(i.firstChild, e, f);
                else { for (var k = h.get(0).parentNode; k && !k.nextSibling && !b.node.isElement(k);) k = k.parentNode; if (k) { var l = k.nextSibling;
                        l && (b.node.isBlock(l) ? g(l.firstChild, e, f) : g(l, e, f)) } } h.is(":empty") && h.remove() } }

        function h(h, i) { var j; if ("undefined" == typeof i && (i = {}), i.style && delete i.style, b.selection.isCollapsed()) { b.markers.insert(); var k = b.$el.find(".fr-marker");
                k.replaceWith(c(h, i) + a.FE.INVISIBLE_SPACE + a.FE.MARKERS + d(h)), b.selection.restore() } else { b.selection.save(); var l = b.$el.find('.fr-marker[data-type="true"]').get(0).nextSibling;
                g(l, h, i); var m;
                do
                    for (m = b.$el.find(e(h, i) + " > " + e(h, i)), j = 0; j < m.length; j++) m[j].outerHTML = m[j].innerHTML; while (m.length);
                b.el.normalize(); var n = b.el.querySelectorAll(".fr-marker"); for (j = 0; j < n.length; j++) { var o = a(n[j]);
                    o.data("type") === !0 ? f(o.get(0).nextSibling, e(h, i)) && o.next().prepend(o) : f(o.get(0).previousSibling, e(h, i)) && o.prev().append(o) } b.selection.restore() } }

        function i(a, c, d, g) { if (!g) { var h = !1; if (a.data("type") === !0)
                    for (; b.node.isFirstSibling(a.get(0)) && !a.parent().is(b.$el) && !a.parent().is("ol") && !a.parent().is("ul");) a.parent().before(a), h = !0;
                else if (a.data("type") === !1)
                    for (; b.node.isLastSibling(a.get(0)) && !a.parent().is(b.$el) && !a.parent().is("ol") && !a.parent().is("ul");) a.parent().after(a), h = !0; if (h) return !0 } if (a.parents(c).length || "undefined" == typeof c) { var i = "",
                    j = "",
                    k = a.parent(); if (k.is(b.$el) || b.node.isBlock(k.get(0))) return !1; for (; !b.node.isBlock(k.parent().get(0)) && ("undefined" == typeof c || "undefined" != typeof c && !f(k.get(0), e(c, d)));) i += b.node.closeTagString(k.get(0)), j = b.node.openTagString(k.get(0)) + j, k = k.parent(); var l = a.get(0).outerHTML;
                a.replaceWith('<span id="mark"></span>'); var m = k.html().replace(/<span id="mark"><\/span>/, i + b.node.closeTagString(k.get(0)) + j + l + i + b.node.openTagString(k.get(0)) + j); return k.replaceWith(b.node.openTagString(k.get(0)) + m + b.node.closeTagString(k.get(0))), !0 } return !1 }

        function j(c, d, g, h) { for (var i = b.node.contents(c.get(0)), k = 0; k < i.length; k++) { var l = i[k]; if (b.node.hasClass(l, "fr-marker")) d = (d + 1) % 2;
                else if (d)
                    if (a(l).find(".fr-marker").length > 0) d = j(a(l), d, g, h);
                    else { for (var m = a(l).find(g || "*"), n = m.length - 1; n >= 0; n--) { var o = m[n];
                            b.node.isBlock(o) || b.node.isVoid(o) || "undefined" != typeof g && !f(o, e(g, h)) || (o.outerHTML = o.innerHTML) } "undefined" == typeof g && l.nodeType == Node.ELEMENT_NODE && !b.node.isVoid(l) && !b.node.isBlock(l) || f(l, e(g, h)) ? a(l).replaceWith(l.innerHTML) : "undefined" == typeof g && l.nodeType == Node.ELEMENT_NODE && b.node.isBlock(l) && b.node.clearAttributes(l) } else a(l).find(".fr-marker").length > 0 && (d = j(a(l), d, g, h)) } return d }

        function k(c, d) { "undefined" == typeof d && (d = {}), d.style && delete d.style; var e = b.selection.isCollapsed();
            b.selection.save(); for (var f = !0; f;) { f = !1; for (var g = b.$el.find(".fr-marker"), h = 0; h < g.length; h++) { var k = a(g[h]),
                        l = null; if (k.attr("data-cloned") || e || (l = k.clone().removeClass("fr-marker").addClass("fr-clone"), k.data("type") === !0 ? k.attr("data-cloned", !0).after(l) : k.attr("data-cloned", !0).before(l)), i(k, c, d, e)) { f = !0; break } } } j(b.$el, 0, c, d), e || (b.$el.find(".fr-marker").remove(), b.$el.find(".fr-clone").removeClass("fr-clone").addClass("fr-marker")), e && b.$el.find(".fr-marker").before(a.FE.INVISIBLE_SPACE).after(a.FE.INVISIBLE_SPACE), b.html.cleanEmptyTags(), b.el.normalize(), b.selection.restore() }

        function l(a, b) { q(a, b) ? k(a, b) : h(a, b) }

        function m(b, c) { var d = a(b);
            d.css(c, ""), "" === d.attr("style") && d.replaceWith(d.html()) }

        function n(b, c) { return 0 === a(b).attr("style").indexOf(c + ":") || a(b).attr("style").indexOf(";" + c + ":") >= 0 || a(b).attr("style").indexOf("; " + c + ":") >= 0 }

        function o(c, d) {
            var e, f;
            if (b.selection.isCollapsed()) { b.markers.insert(), f = b.$el.find(".fr-marker"); var h = f.parent(); if (b.node.openTagString(h.get(0)) == '<span style="' + c + ": " + h.css(c) + ';">') { if (b.node.isEmpty(h.get(0))) h.replaceWith('<span style="' + c + ": " + d + ';">' + a.FE.INVISIBLE_SPACE + a.FE.MARKERS + "</span>");
                    else { var j = {};
                        j["style*"] = c + ":", i(f, "span", j, !0), f = b.$el.find(".fr-marker"), d ? f.replaceWith('<span style="' + c + ": " + d + ';">' + a.FE.INVISIBLE_SPACE + a.FE.MARKERS + "</span>") : f.replaceWith(a.FE.INVISIBLE_SPACE + a.FE.MARKERS) } b.html.cleanEmptyTags() } else b.node.isEmpty(h.get(0)) && h.is("span") ? (f.replaceWith(a.FE.MARKERS), h.css(c, d)) : f.replaceWith('<span style="' + c + ": " + d + ';">' + a.FE.INVISIBLE_SPACE + a.FE.MARKERS + "</span>");
                b.selection.restore() } else {
                if (b.selection.save(), null == d || "color" == c && b.$el.find(".fr-marker").parents("u, a").length > 0) { var k = b.$el.find(".fr-marker"); for (e = 0; e < k.length; e++)
                        if (f = a(k[e]), f.data("type") === !0)
                            for (; b.node.isFirstSibling(f.get(0)) && !f.parent().is(b.$el) && !b.node.isElement(f.parent().get(0)) && !b.node.isBlock(f.parent().get(0));) f.parent().before(f);
                        else
                            for (; b.node.isLastSibling(f.get(0)) && !f.parent().is(b.$el) && !b.node.isElement(f.parent().get(0)) && !b.node.isBlock(f.parent().get(0));) f.parent().after(f) }
                var l = b.$el.find('.fr-marker[data-type="true"]').get(0).nextSibling,
                    o = { class: "fr-unprocessed" };
                for (d && (o.style = c + ": " + d + ";"), g(l, "span", o), b.$el.find(".fr-marker + .fr-unprocessed").each(function() { a(this).prepend(a(this).prev()) }), b.$el.find(".fr-unprocessed + .fr-marker").each(function() { a(this).prev().append(this) }), (d || "").match(/\dem$/) && b.$el.find("span.fr-unprocessed").removeClass("fr-unprocessed"); b.$el.find("span.fr-unprocessed").length > 0;) { var p = b.$el.find("span.fr-unprocessed:first").removeClass("fr-unprocessed"); if (p.parent().get(0).normalize(), p.parent().is("span") && 1 == p.parent().get(0).childNodes.length) { p.parent().css(c, d); var q = p;
                        p = p.parent(), q.replaceWith(q.html()) } var r = p.find("span"); for (e = r.length - 1; e >= 0; e--) m(r[e], c); var s = p.parentsUntil(b.$el, "span[style]"),
                        t = []; for (e = s.length - 1; e >= 0; e--) n(s[e], c) || t.push(s[e]); if (s = s.not(t), s.length) { var u = "",
                            v = "",
                            w = "",
                            x = "",
                            y = p.get(0);
                        do y = y.parentNode, a(y).addClass("fr-split"), u += b.node.closeTagString(y), v = b.node.openTagString(a(y).clone().addClass("fr-split").get(0)) + v, s.get(0) != y && (w += b.node.closeTagString(y), x = b.node.openTagString(a(y).clone().addClass("fr-split").get(0)) + x); while (s.get(0) != y); var z = u + b.node.openTagString(a(s.get(0)).clone().css(c, d || "").get(0)) + x + p.css(c, "").get(0).outerHTML + w + "</span>" + v;
                        p.replaceWith('<span id="fr-break"></span>'); var A = s.get(0).outerHTML;
                        a(s.get(0)).replaceWith(A.replace(/<span id="fr-break"><\/span>/g, z)) } }
                for (; b.$el.find(".fr-split:empty").length > 0;) b.$el.find(".fr-split:empty").remove();
                b.$el.find(".fr-split").removeClass("fr-split"), b.$el.find('span[style=""]').removeAttr("style"), b.$el.find('span[class=""]').removeAttr("class"), b.html.cleanEmptyTags(), a(b.$el.find("span").get().reverse()).each(function() { this.attributes && 0 !== this.attributes.length || a(this).replaceWith(this.innerHTML) }), b.el.normalize();
                var B = b.$el.find("span[style] + span[style]");
                for (e = 0; e < B.length; e++) {
                    var C = a(B[e]),
                        D = a(B[e]).prev();
                    C.get(0).previousSibling == D.get(0) && b.node.openTagString(C.get(0)) == b.node.openTagString(D.get(0)) && (C.prepend(D.html()), D.remove());
                }
                b.$el.find("span[style] span[style]").each(function() { if (a(this).attr("style").indexOf("font-size") >= 0) { var b = a(this).parents("span[style]");
                        b.attr("style").indexOf("background-color") >= 0 && (a(this).attr("style", a(this).attr("style") + ";" + b.attr("style")), i(a(this), "span[style]", {}, !1)) } }), b.el.normalize(), b.selection.restore()
            }
        }

        function p(a) { o(a, null) }

        function q(a, c) { "undefined" == typeof c && (c = {}), c.style && delete c.style; var d = b.selection.ranges(0),
                g = d.startContainer; if (g.nodeType == Node.ELEMENT_NODE && g.childNodes.length > 0 && g.childNodes[d.startOffset] && (g = g.childNodes[d.startOffset]), !d.collapsed && g.nodeType == Node.TEXT_NODE && d.startOffset == (g.textContent || "").length) { for (; !b.node.isBlock(g.parentNode) && !g.nextSibling;) g = g.parentNode;
                g.nextSibling && (g = g.nextSibling) } for (var h = g; h && h.nodeType == Node.ELEMENT_NODE && !f(h, e(a, c));) h = h.firstChild; if (h && h.nodeType == Node.ELEMENT_NODE && f(h, e(a, c))) return !0; var i = g; for (i && i.nodeType != Node.ELEMENT_NODE && (i = i.parentNode); i && i.nodeType == Node.ELEMENT_NODE && i != b.el && !f(i, e(a, c));) i = i.parentNode; return !(!i || i.nodeType != Node.ELEMENT_NODE || i == b.el || !f(i, e(a, c))) }
        return { is: q, toggle: l, apply: h, remove: k, applyStyle: o, removeStyle: p }
    }, a.extend(a.FE.DEFAULTS, { indentMargin: 20 }), a.FE.COMMANDS = { bold: { title: "Bold", toggle: !0, refresh: function(a) { var b = this.format.is("strong");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, italic: { title: "Italic", toggle: !0, refresh: function(a) { var b = this.format.is("em");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, underline: { title: "Underline", toggle: !0, refresh: function(a) { var b = this.format.is("u");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, strikeThrough: { title: "Strikethrough", toggle: !0, refresh: function(a) { var b = this.format.is("s");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, subscript: { title: "Subscript", toggle: !0, refresh: function(a) { var b = this.format.is("sub");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, superscript: { title: "Superscript", toggle: !0, refresh: function(a) { var b = this.format.is("sup");
                a.toggleClass("fr-active", b).attr("aria-pressed", b) } }, outdent: { title: "Decrease Indent" }, indent: { title: "Increase Indent" }, undo: { title: "Undo", undo: !1, forcedRefresh: !0, disabled: !0 }, redo: { title: "Redo", undo: !1, forcedRefresh: !0, disabled: !0 }, insertHR: { title: "Insert Horizontal Line" }, clearFormatting: { title: "Clear Formatting" }, selectAll: { title: "Select All", undo: !1 } }, a.FE.RegisterCommand = function(b, c) { a.FE.COMMANDS[b] = c }, a.FE.MODULES.commands = function(b) {
        function c(a) { return b.html.defaultTag() && (a = "<" + b.html.defaultTag() + ">" + a + "</" + b.html.defaultTag() + ">"), a }

        function d(c, d) { if (b.events.trigger("commands.before", a.merge([c], d || [])) !== !1) { var e = a.FE.COMMANDS[c] && a.FE.COMMANDS[c].callback || i[c],
                    f = !0,
                    g = !1;
                a.FE.COMMANDS[c] && ("undefined" != typeof a.FE.COMMANDS[c].focus && (f = a.FE.COMMANDS[c].focus), "undefined" != typeof a.FE.COMMANDS[c].accessibilityFocus && (g = a.FE.COMMANDS[c].accessibilityFocus)), (!b.core.hasFocus() && f && !b.popups.areVisible() || !b.core.hasFocus() && g && b.accessibility.hasFocus()) && b.events.focus(!0), a.FE.COMMANDS[c] && a.FE.COMMANDS[c].undo !== !1 && (b.$el.find(".fr-marker").length && (b.events.disableBlur(), b.selection.restore()), b.undo.saveStep()), e && e.apply(b, a.merge([c], d || [])), b.events.trigger("commands.after", a.merge([c], d || [])), a.FE.COMMANDS[c] && a.FE.COMMANDS[c].undo !== !1 && b.undo.saveStep() } }

        function e(a, c) { b.format.toggle(c) }

        function f(c) { b.selection.save(), b.html.wrap(!0, !0, !0, !0), b.selection.restore(); for (var d = b.selection.blocks(), e = 0; e < d.length; e++)
                if ("LI" != d[e].tagName && "LI" != d[e].parentNode.tagName) { var f = a(d[e]),
                        g = "rtl" == b.opts.direction || "rtl" == f.css("direction") ? "margin-right" : "margin-left",
                        h = b.helpers.getPX(f.css(g));
                    f.css(g, Math.max(h + c * b.opts.indentMargin, 0) || ""), f.removeClass("fr-temp-div") }
            b.selection.save(), b.html.unwrap(), b.selection.restore() }

        function g(a) { return function() { d(a) } }

        function h() { b.events.on("keydown", function(a) { var c = b.selection.element(); if (c && "HR" == c.tagName && !b.keys.isArrow(a.which)) return a.preventDefault(), !1 }), b.events.on("keyup", function(c) { var d = b.selection.element(); if (d && "HR" == d.tagName)
                    if (c.which == a.FE.KEYCODE.ARROW_LEFT || c.which == a.FE.KEYCODE.ARROW_UP) { if (d.previousSibling) return b.node.isBlock(d.previousSibling) ? b.selection.setAtEnd(d.previousSibling) : a(d).before(a.FE.MARKERS), b.selection.restore(), !1 } else if ((c.which == a.FE.KEYCODE.ARROW_RIGHT || c.which == a.FE.KEYCODE.ARROW_DOWN) && d.nextSibling) return b.node.isBlock(d.nextSibling) ? b.selection.setAtStart(d.nextSibling) : a(d).after(a.FE.MARKERS), b.selection.restore(), !1 }), b.events.on("mousedown", function(a) { if (a.target && "HR" == a.target.tagName) return a.preventDefault(), a.stopPropagation(), !1 }), b.events.on("mouseup", function() { var c = b.selection.element(),
                    d = b.selection.endElement();
                c == d && c && "HR" == c.tagName && (c.nextSibling && (b.node.isBlock(c.nextSibling) ? b.selection.setAtStart(c.nextSibling) : a(c).after(a.FE.MARKERS)), b.selection.restore()) }) } var i = { bold: function() { e("bold", "strong") }, subscript: function() { b.format.is("sup") && b.format.remove("sup"), e("subscript", "sub") }, superscript: function() { b.format.is("sub") && b.format.remove("sub"), e("superscript", "sup") }, italic: function() { e("italic", "em") }, strikeThrough: function() { e("strikeThrough", "s") }, underline: function() { e("underline", "u") }, undo: function() { b.undo.run() }, redo: function() { b.undo.redo() }, indent: function() { f(1) }, outdent: function() { f(-1) }, show: function() { b.opts.toolbarInline && b.toolbar.showInline(null, !0) }, insertHR: function() { b.selection.remove(); var d = "";
                    b.core.isEmpty() && (d = "<br>", d = c(d)), b.html.insert('<hr id="fr-just">' + d); var e = b.$el.find("hr#fr-just");
                    e.removeAttr("id"); var f; if (0 === e.next().length) { var g = b.html.defaultTag();
                        g ? e.after(a("<" + g + ">").append("<br>")) : e.after("<br>") } e.prev().is("hr") ? f = b.selection.setAfter(e.get(0), !1) : e.next().is("hr") ? f = b.selection.setBefore(e.get(0), !1) : b.selection.setAfter(e.get(0), !1) || b.selection.setBefore(e.get(0), !1), f || "undefined" == typeof f || (d = a.FE.MARKERS + "<br>", d = c(d), e.after(d)), b.selection.restore() }, clearFormatting: function() { b.format.remove() }, selectAll: function() { b.doc.execCommand("selectAll", !1, !1) } },
            j = {}; for (var k in i) i.hasOwnProperty(k) && (j[k] = g(k)); return a.extend(j, { exec: d, _init: h }) }, a.FE.MODULES.data = function(a) {
        function b(a) { return a }

        function c(a) { if (!a) return a; for (var c = "", f = b("charCodeAt"), g = b("fromCharCode"), h = l.indexOf(a[0]), i = 1; i < a.length - 2; i++) { for (var j = d(++h), k = a[f](i), m = "";
                    /[0-9-]/.test(a[i + 1]);) m += a[++i];
                m = parseInt(m, 10) || 0, k = e(k, j, m), k ^= h - 1 & 31, c += String[g](k) } return c }

        function d(a) { for (var b = a.toString(), c = 0, d = 0; d < b.length; d++) c += parseInt(b.charAt(d), 10); return c > 10 ? c % 9 + 1 : c }

        function e(a, b, c) { for (var d = Math.abs(c); d-- > 0;) a -= b; return c < 0 && (a += 123), a }

        function f(a) { return !(!a || "block" === a.css("display") || (a.remove(), 0)) }

        function g() { return f(j) || f(k) }

        function i() { var c = a.o_win.FEK; try { c = c || localStorage && localStorage.FEK } catch (d) {} c = c || a.opts.key || [""]; var e = n(b("ziRA1E3B9pA5B-11D-11xg1A3ZB5D1D4B-11ED2EG2pdeoC1clIH4wB-22yQD5uF4YE3E3A9==")); "string" == typeof c && (c = [c]), a.ul = !0; for (var f = 0; f < c.length; f++) { var i = n(c[f]) || ""; if (!(i !== n(b(n("mcVRDoB1BGILD7YFe1BTXBA7B6=="))) && i.indexOf(m, i.length - m.length) < 0 && [n("9qqG-7amjlwq=="), n("KA3B3C2A6D1D5H5H1A3=="), n("QzbzvxyB2yA-9m=="), n("ji1kacwmgG5bc=="), n("naamngiA3dA-16xtE-11C-9B1H-8sc==")].indexOf(m) < 0)) { a.ul = !1; break } } var k = new Image;
            a.ul === !0 && (k.src = b(n(e)) + "u"), a.events.on("contentChanged", function() { a.ul === !0 && g() }), a.events.on("destroy", function() { j && j.length && j.remove() }, !0) } var j, k, l = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789",
            m = function() { for (var a = 0, b = document.domain, c = b.split("."), d = "_gd" + (new Date).getTime(); a < c.length - 1 && document.cookie.indexOf(d + "=" + d) == -1;) b = c.slice(-1 - ++a).join("."), document.cookie = d + "=" + d + ";domain=" + b + ";"; return document.cookie = d + "=;expires=Thu, 01 Jan 1970 00:00:01 GMT;domain=" + b + ";", (b || "").replace(/(^\.*)|(\.*$)/g, "") }(),
            n = b(c),
            o = 0; return { _init: i } }, a.extend(a.FE.DEFAULTS, { pastePlain: !1, pasteDeniedTags: ["colgroup", "col", "meta"], pasteDeniedAttrs: ["class", "id", "style"], pasteAllowedStyleProps: [], pasteAllowLocalImages: !1 }), a.FE.COPIED_TOKEN = '<span data-copied-from-froala-editor="true"></span>', a.FE.MODULES.paste = function(b) {
        function c(b, c, d) { b && b.clipboardData && b.clipboardData.setData && (b.clipboardData.setData("text/html", c + a.FE.COPIED_TOKEN), b.clipboardData.setData("text/plain", d), b.preventDefault()) }

        function d(d) { var e = b.html.getSelected();
            c(d, e, a("<div>").html(e).text()), "cut" == d.type && (b.undo.saveStep(), setTimeout(function() { b.selection.save(), b.html.wrap(), b.selection.restore(), b.events.focus(), b.undo.saveStep() }, 0)) }

        function e(a) { if (w) return !1; if (a.originalEvent && (a = a.originalEvent), b.events.trigger("paste.before", [a]) === !1) return a.preventDefault(), !1; if (r = b.$win.scrollTop(), a && a.clipboardData && a.clipboardData.getData) { var c = "",
                    d = a.clipboardData.types; if (b.helpers.isArray(d))
                    for (var e = 0; e < d.length; e++) c += d[e] + ";";
                else c = d; if (/text\/rtf/.test(c) && (t = a.clipboardData.getData("text/rtf")), /text\/html/.test(c) ? s = a.clipboardData.getData("text/html") : /text\/rtf/.test(c) && b.browser.safari ? s = t : /text\/plain/.test(c) && !b.browser.mozilla && (s = b.html.escapeEntities(a.clipboardData.getData("text/plain")).replace(/\n/g, "<br>")), "" !== s) return j(), a.preventDefault && (a.stopPropagation(), a.preventDefault()), !1;
                s = null } return g(), !1 }

        function f(c) { if (c.originalEvent && (c = c.originalEvent), c && c.dataTransfer && c.dataTransfer.getData) { var d = "",
                    e = c.dataTransfer.types; if (b.helpers.isArray(e))
                    for (var f = 0; f < e.length; f++) d += e[f] + ";";
                else d = e; if (s = "", /text\/rtf/.test(d) && (t = c.dataTransfer.getData("text/rtf")), /text\/html/.test(d) ? s = c.dataTransfer.getData("text/html") : /text\/rtf/.test(d) && b.browser.safari ? s = t : /text\/plain/.test(d) && !this.browser.mozilla && (s = b.html.escapeEntities(c.dataTransfer.getData("text/plain")).replace(/\n/g, "<br>")), "" !== s) { b.keys.forceUndo(), v = b.snapshot.get(), b.selection.remove(); var g = b.markers.insertAtPoint(c); if (g !== !1) { var h = b.el.querySelector(".fr-marker"); return a(h).replaceWith(a.FE.MARKERS), j(), c.preventDefault && (c.stopPropagation(), c.preventDefault()), !1 } } else s = null } }

        function g() { b.selection.save(), b.events.disableBlur(), s = null, u ? (u.html(""), b.browser.edge && b.opts.iframe && b.$el.append(u)) : (u = a('<div contenteditable="true" style="position: fixed; top: 0; left: -9999px; height: 100%; width: 0; word-break: break-all; overflow:hidden; z-index: 2147483647; line-height: 140%;" tabIndex="-1"></div>'), b.browser.safari ? (u.css("top", b.$sc.scrollTop()), b.$el.after(u)) : b.browser.edge && b.opts.iframe ? b.$el.append(u) : b.$box.after(u), b.events.on("destroy", function() { u.remove() })), u.focus(), b.win.setTimeout(j, 1) }

        function h(a) { var c;
            a = a.replace(/<p(.*?)class="?'?MsoListParagraph"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li>$3</li></ul>"), a = a.replace(/<p(.*?)class="?'?NumberedText"?'? ([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li>$3</li></ol>"), a = a.replace(/<p(.*?)class="?'?MsoListParagraphCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ul><li$3>$5</li>"), a = a.replace(/<p(.*?)class="?'?NumberedTextCxSpFirst"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<ol><li$3>$5</li>"), a = a.replace(/<p(.*?)class="?'?MsoListParagraphCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>"), a = a.replace(/<p(.*?)class="?'?NumberedTextCxSpMiddle"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>"), a = a.replace(/<p(.*?)class="?'?MsoListBullet"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li>"), a = a.replace(/<p(.*?)class="?'?MsoListParagraphCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ul>"), a = a.replace(/<p(.*?)class="?'?NumberedTextCxSpLast"?'?([\s\S]*?)(level\d)?([\s\S]*?)>([\s\S]*?)<\/p>/gi, "<li$3>$5</li></ol>"), a = a.replace(/<span([^<]*?)style="?'?mso-list:Ignore"?'?([\s\S]*?)>([\s\S]*?)<span/gi, "<span><span"), a = a.replace(/<!--\[if \!supportLists\]-->([\s\S]*?)<!--\[endif\]-->/gi, ""), a = a.replace(/<!\[if \!supportLists\]>([\s\S]*?)<!\[endif\]>/gi, ""), a = a.replace(/(\n|\r| class=(")?Mso[a-zA-Z0-9]+(")?)/gi, " "), a = a.replace(/<!--[\s\S]*?-->/gi, ""), a = a.replace(/<(\/)*(meta|link|span|\\?xml:|st1:|o:|font)(.*?)>/gi, ""); var d = ["style", "script", "applet", "embed", "noframes", "noscript"]; for (c = 0; c < d.length; c++) { var e = new RegExp("<" + d[c] + ".*?" + d[c] + "(.*?)>", "gi");
                a = a.replace(e, "") } a = a.replace(/&nbsp;/gi, " "), a = a.replace(/<td([^>]*)><\/td>/g, "<td$1><br></td>"), a = a.replace(/<th([^>]*)><\/th>/g, "<th$1><br></th>"); var f;
            do f = a, a = a.replace(/<[^\/>][^>]*><\/[^>]+>/gi, ""); while (a != f);
            a = a.replace(/<lilevel([^1])([^>]*)>/gi, '<li data-indent="true"$2>'), a = a.replace(/<lilevel1([^>]*)>/gi, "<li$1>"), a = b.clean.html(a, b.opts.pasteDeniedTags, b.opts.pasteDeniedAttrs), a = a.replace(/<a>(.[^<]+)<\/a>/gi, "$1"), a = a.replace(/<br> */g, "<br>"); var g = b.o_doc.createElement("div");
            g.innerHTML = a; var h = g.querySelectorAll("li[data-indent]"); for (c = 0; c < h.length; c++) { var i = h[c],
                    j = i.previousElementSibling; if (j && "LI" == j.tagName) { var k = j.querySelector(":scope > ul, :scope > ol");
                    k || (k = document.createElement("ul"), j.appendChild(k)), k.appendChild(i) } else i.removeAttribute("data-indent") } return b.html.cleanBlankSpaces(g), a = g.innerHTML }

        function i(a) { var c, d = null,
                e = b.doc.createElement("div");
            e.innerHTML = a; var f = e.querySelectorAll("p, div, h1, h2, h3, h4, h5, h6, pre, blockquote"); for (c = 0; c < f.length; c++) d = f[c], d.outerHTML = "<" + (b.html.defaultTag() || "DIV") + ">" + d.innerHTML + "</" + (b.html.defaultTag() || "DIV") + ">"; for (f = e.querySelectorAll("*:not(" + "p, div, h1, h2, h3, h4, h5, h6, pre, blockquote, ul, ol, li, table, tbody, thead, tr, td, br, img".split(",").join("):not(") + ")"), c = f.length - 1; c >= 0; c--) d = f[c], d.outerHTML = d.innerHTML; var g = function(a) { for (var c = b.node.contents(a), d = 0; d < c.length; d++) c[d].nodeType != Node.TEXT_NODE && c[d].nodeType != Node.ELEMENT_NODE ? c[d].parentNode.removeChild(c[d]) : g(c[d]) }; return g(e), e.innerHTML }

        function j() { b.browser.edge && b.opts.iframe && b.$box.after(u), v || (b.keys.forceUndo(), v = b.snapshot.get()), null === s && (s = u.get(0).innerHTML, b.selection.restore(), b.events.enableBlur()); var a = s.match(/(class=\"?Mso|class=\'?Mso|class="?Xl|class='?Xl|class=Xl|style=\"[^\"]*\bmso\-|style=\'[^\']*\bmso\-|w:WordDocument)/gi),
                c = b.events.chainTrigger("paste.beforeCleanup", s);
            c && "string" == typeof c && (s = c), (!a || a && b.events.trigger("paste.wordPaste", [s]) !== !1) && l(s, a) }

        function k(b) { return !!b.match(new RegExp(a.FE.COPIED_TOKEN)) }

        function l(c, d, e) { var f, g = null,
                j = null;
            c.toLowerCase().indexOf("<body") >= 0 && (c = c.replace(/[.\s\S\w\W<>]*<body[^>]*>[\s]*([.\s\S\w\W<>]*)[\s]*<\/body>[.\s\S\w\W<>]*/gi, "$1"), c = c.replace(/ \n/g, " ").replace(/\n /g, " ").replace(/([^>])\n([^<])/g, "$1 $2")); var l = !1; if (c.indexOf('id="docs-internal-guid') >= 0 && (c = c.replace(/^[\w\W\s\S]* id="docs-internal-guid[^>]*>([\w\W\s\S]*)<\/b>[\w\W\s\S]*$/g, "$1"), l = !0), !d) { var n = k(c); if (n && (c = c.replace(new RegExp(a.FE.COPIED_TOKEN), ""), c = c.replace(/<meta charset='utf-8'>/g, "").replace(/<!--StartFragment-->/g, "").replace(/<!--EndFragment-->/g, ""), c = c.replace(/^(\r|\n|\t)*/g, "").replace(/(\r|\n|\t)*$/g, "")), !n) { var p = b.opts.htmlAllowedStyleProps;
                    b.opts.htmlAllowedStyleProps = b.opts.pasteAllowedStyleProps, b.opts.htmlAllowComments = !1, c = b.clean.html(c, b.opts.pasteDeniedTags, b.opts.pasteDeniedAttrs), b.opts.htmlAllowedStyleProps = p, b.opts.htmlAllowComments = !0, c = o(c), c = c.replace(/\r|\n|\t/g, ""), c = c.replace(/^ */g, "").replace(/ *$/g, "") } }!d || b.wordPaste && e || (c = c.replace(/^\n*/g, "").replace(/^ /g, ""), 0 === c.indexOf("<colgroup>") && (c = "<table>" + c + "</table>"), c = h(c), c = o(c)), b.opts.pastePlain && (c = i(c)); var q = b.events.chainTrigger("paste.afterCleanup", c); if ("string" == typeof q && (c = q), "" !== c) { var r = b.o_doc.createElement("div");
                r.innerHTML = c, b.spaces.normalize(r); var s = r.getElementsByTagName("span"); for (f = s.length - 1; f >= 0; f--) { var t = s[f];
                    0 === t.attributes.length && (t.outerHTML = t.innerHTML) } var u = b.selection.element(),
                    w = !1; if (u && a(u).parentsUntil(b.el, "ul, ol").length && (w = !0), w) { var x = r.children;
                    1 == x.length && ["OL", "UL"].indexOf(x[0].tagName) >= 0 && (x[0].outerHTML = x[0].innerHTML) } if (!l) { var y = r.getElementsByTagName("br"); for (f = y.length - 1; f >= 0; f--) { var z = y[f];
                        b.node.isBlock(z.previousSibling) && z.parentNode.removeChild(z) } } if (b.opts.enter == a.FE.ENTER_BR)
                    for (g = r.querySelectorAll("p, div"), f = g.length - 1; f >= 0; f--) j = g[f], 0 === j.attributes.length && (j.outerHTML = j.innerHTML + (j.nextSibling && !b.node.isEmpty(j) ? "<br>" : ""));
                else if (b.opts.enter == a.FE.ENTER_DIV)
                    for (g = r.getElementsByTagName("p"), f = g.length - 1; f >= 0; f--) j = g[f], j.outerHTML = "<div>" + j.innerHTML + "</div>";
                else b.opts.enter == a.FE.ENTER_P && 1 == r.childNodes.length && "P" == r.childNodes[0].tagName && (r.childNodes[0].outerHTML = r.childNodes[0].innerHTML);
                c = r.innerHTML, b.html.insert(c, !0) } m(), b.undo.saveStep(v), v = null, b.undo.saveStep() }

        function m() { b.events.trigger("paste.after") }

        function n() { return t }

        function o(c) { var d, e = b.o_doc.createElement("div");
            e.innerHTML = c; for (var f = e.querySelectorAll("*:empty:not(td):not(th):not(iframe):not(svg):not(" + a.FE.VOID_ELEMENTS.join("):not(") + ")"); f.length;) { for (d = 0; d < f.length; d++) f[d].parentNode.removeChild(f[d]);
                f = e.querySelectorAll("*:empty:not(td):not(th):not(iframe):not(svg):not(" + a.FE.VOID_ELEMENTS.join("):not(") + ")") } for (var g = e.querySelectorAll(":scope > div:not([style]), td > div:not([style]), th > div:not([style]), li > div:not([style])"); g.length;) { var h = g[g.length - 1]; if (b.html.defaultTag() && "div" != b.html.defaultTag()) h.querySelector(b.html.blockTagsQuery()) ? h.outerHTML = h.innerHTML : h.outerHTML = "<" + b.html.defaultTag() + ">" + h.innerHTML + "</" + b.html.defaultTag() + ">";
                else { var i = h.querySelectorAll("*");!i.length || "BR" !== i[i.length - 1].tagName && 0 === h.innerText.length ? h.outerHTML = h.innerHTML + "<br>" : h.outerHTML = h.innerHTML } g = e.querySelectorAll(":scope > div:not([style]), td > div:not([style]), th > div:not([style]), li > div:not([style])") } for (g = e.querySelectorAll("div:not([style])"); g.length;) { for (d = 0; d < g.length; d++) { var j = g[d],
                        k = j.innerHTML.replace(/\u0009/gi, "").trim();
                    j.outerHTML = k } g = e.querySelectorAll("div:not([style])") } return e.innerHTML }

        function p() { b.el.addEventListener("copy", d), b.el.addEventListener("cut", d), b.el.addEventListener("paste", e, { capture: !0 }), b.events.on("drop", f), b.browser.msie && b.browser.version < 11 && (b.events.on("mouseup", function(a) { 2 == a.button && (setTimeout(function() { w = !1 }, 50), w = !0) }, !0), b.events.on("beforepaste", e)), b.events.on("destroy", q) }

        function q() { b.el.removeEventListener("copy", d), b.el.removeEventListener("cut", d), b.el.removeEventListener("paste", e) } var r, s, t, u, v, w = !1; return { _init: p, removeEmptyTags: o, getRtfClipboard: n, saveCopiedText: c, clean: l } }, a.extend(a.FE.DEFAULTS, { shortcutsEnabled: [], shortcutsHint: !0 }), a.FE.SHORTCUTS_MAP = {}, a.FE.RegisterShortcut = function(b, c, d, e, f, g) { a.FE.SHORTCUTS_MAP[(f ? "^" : "") + (g ? "@" : "") + b] = { cmd: c, val: d, letter: e, shift: f, option: g }, a.FE.DEFAULTS.shortcutsEnabled.push(c) }, a.FE.RegisterShortcut(a.FE.KEYCODE.E, "show", null, "E", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.B, "bold", null, "B", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.I, "italic", null, "I", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.U, "underline", null, "U", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.S, "strikeThrough", null, "S", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.CLOSE_SQUARE_BRACKET, "indent", null, "]", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.OPEN_SQUARE_BRACKET, "outdent", null, "[", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.Z, "undo", null, "Z", !1, !1), a.FE.RegisterShortcut(a.FE.KEYCODE.Z, "redo", null, "Z", !0, !1), a.FE.MODULES.shortcuts = function(b) {
        function c(c) { if (!b.opts.shortcutsHint) return null; if (!f) { f = {}; for (var d in a.FE.SHORTCUTS_MAP) a.FE.SHORTCUTS_MAP.hasOwnProperty(d) && b.opts.shortcutsEnabled.indexOf(a.FE.SHORTCUTS_MAP[d].cmd) >= 0 && (f[a.FE.SHORTCUTS_MAP[d].cmd + "." + (a.FE.SHORTCUTS_MAP[d].val || "")] = { shift: a.FE.SHORTCUTS_MAP[d].shift, option: a.FE.SHORTCUTS_MAP[d].option, letter: a.FE.SHORTCUTS_MAP[d].letter }) } var e = f[c]; return e ? (b.helpers.isMac() ? String.fromCharCode(8984) : "Ctrl+") + (e.shift ? b.helpers.isMac() ? String.fromCharCode(8679) : "Shift+" : "") + (e.option ? b.helpers.isMac() ? String.fromCharCode(8997) : "Alt+" : "") + e.letter : null }

        function d(c) { if (!b.core.hasFocus()) return !0; var d = c.which,
                e = navigator.userAgent.indexOf("Mac OS X") != -1 ? c.metaKey : c.ctrlKey; if ("keyup" == c.type && g && d != a.FE.KEYCODE.META) return g = !1, !1; "keydown" == c.type && (g = !1); var f = (c.shiftKey ? "^" : "") + (c.altKey ? "@" : "") + d; if (e && a.FE.SHORTCUTS_MAP[f]) { var h = a.FE.SHORTCUTS_MAP[f].cmd; if (h && b.opts.shortcutsEnabled.indexOf(h) >= 0) { var i, j = a.FE.SHORTCUTS_MAP[f].val; if (h && !j ? i = b.$tb.find('.fr-command[data-cmd="' + h + '"]') : h && j && (i = b.$tb.find('.fr-command[data-cmd="' + h + '"][data-param1="' + j + '"]')), i.length) return c.preventDefault(), c.stopPropagation(), i.parents(".fr-toolbar").data("instance", b), "keydown" == c.type && (b.button.exec(i), g = !0), !1; if (h && b.commands[h]) return c.preventDefault(), c.stopPropagation(), "keydown" == c.type && (b.commands[h](), g = !0), !1 } } }

        function e() { b.events.on("keydown", d, !0), b.events.on("keyup", d, !0) } var f = null,
            g = !1; return { _init: e, get: c } }, a.FE.MODULES.snapshot = function(a) {
        function b(a) { for (var b = a.parentNode.childNodes, c = 0, d = null, e = 0; e < b.length; e++) { if (d) { var f = b[e].nodeType === Node.TEXT_NODE && "" === b[e].textContent,
                        g = d.nodeType === Node.TEXT_NODE && b[e].nodeType === Node.TEXT_NODE;
                    f || g || c++ } if (b[e] == a) return c;
                d = b[e] } }

        function c(c) { var d = []; if (!c.parentNode) return []; for (; !a.node.isElement(c);) d.push(b(c)), c = c.parentNode; return d.reverse() }

        function d(a, b) { for (; a && a.nodeType === Node.TEXT_NODE;) { var c = a.previousSibling;
                c && c.nodeType == Node.TEXT_NODE && (b += c.textContent.length), a = c } return b }

        function e(a) { return { scLoc: c(a.startContainer), scOffset: d(a.startContainer, a.startOffset), ecLoc: c(a.endContainer), ecOffset: d(a.endContainer, a.endOffset) } }

        function f() { var b = {}; if (a.events.trigger("snapshot.before"), b.html = (a.$wp ? a.$el.html() : a.$oel.get(0).outerHTML).replace(/ style=""/g, ""), b.ranges = [], a.$wp && a.selection.inEditor() && a.core.hasFocus())
                for (var c = a.selection.ranges(), d = 0; d < c.length; d++) b.ranges.push(e(c[d])); return a.events.trigger("snapshot.after", [b]), b }

        function g(b) { for (var c = a.el, d = 0; d < b.length; d++) c = c.childNodes[b[d]]; return c }

        function h(b, c) { try { var d = g(c.scLoc),
                    e = c.scOffset,
                    f = g(c.ecLoc),
                    h = c.ecOffset,
                    i = a.doc.createRange();
                i.setStart(d, e), i.setEnd(f, h), b.addRange(i) } catch (j) { console.warn(j) } }

        function i(b) { a.$el.html() != b.html && (a.opts.htmlExecuteScripts ? a.$el.html(b.html) : a.el.innerHTML = b.html); var c = a.selection.get();
            a.selection.clear(), a.events.focus(!0); for (var d = 0; d < b.ranges.length; d++) h(c, b.ranges[d]) }

        function j(b, c) { return b.html == c.html && (!a.core.hasFocus() || JSON.stringify(b.ranges) == JSON.stringify(c.ranges)) } return { get: f, restore: i, equal: j } }, a.FE.MODULES.undo = function(a) {
        function b(b) { var c = b.which,
                d = a.keys.ctrlKey(b);
            d && (90 == c && b.shiftKey && b.preventDefault(), 90 == c && b.preventDefault()) }

        function c() { return !(0 === a.undo_stack.length || a.undo_index <= 1) }

        function d() { return a.undo_index != a.undo_stack.length }

        function e(b) { return !(!a.undo_stack || a.undoing || a.el.querySelector(".fr-marker")) && void("undefined" == typeof b ? (b = a.snapshot.get(), a.undo_stack[a.undo_index - 1] && a.snapshot.equal(a.undo_stack[a.undo_index - 1], b) || (f(), a.undo_stack.push(b), a.undo_index++, b.html != l && (a.events.trigger("contentChanged"), l = b.html))) : (f(), a.undo_index > 0 ? a.undo_stack[a.undo_index - 1] = b : (a.undo_stack.push(b), a.undo_index++))) }

        function f() { if (!a.undo_stack || a.undoing) return !1; for (; a.undo_stack.length > a.undo_index;) a.undo_stack.pop() }

        function g() { if (a.undo_index > 1) { a.undoing = !0; var b = a.undo_stack[--a.undo_index - 1];
                clearTimeout(a._content_changed_timer), a.snapshot.restore(b), l = b.html, a.popups.hideAll(), a.toolbar.enable(), a.events.trigger("contentChanged"), a.events.trigger("commands.undo"), a.undoing = !1 } }

        function h() { if (a.undo_index < a.undo_stack.length) { a.undoing = !0; var b = a.undo_stack[a.undo_index++];
                clearTimeout(a._content_changed_timer), a.snapshot.restore(b), l = b.html, a.popups.hideAll(), a.toolbar.enable(), a.events.trigger("contentChanged"), a.events.trigger("commands.redo"), a.undoing = !1 } }

        function i() { a.undo_index = 0, a.undo_stack = [] }

        function j() { a.undo_stack = [] }

        function k() { i(), a.events.on("initialized", function() { l = (a.$wp ? a.$el.html() : a.$oel.get(0).outerHTML).replace(/ style=""/g, "") }), a.events.on("blur", function() { a.el.querySelector(".fr-dragging") || a.undo.saveStep() }), a.events.on("keydown", b), a.events.on("destroy", j) } var l = null; return { _init: k, run: g, redo: h, canDo: c, canRedo: d, dropRedo: f, reset: i, saveStep: e } }, a.FE.ICON_DEFAULT_TEMPLATE = "font_awesome", a.FE.ICON_TEMPLATES = { font_awesome: '<i class="fa fa-[NAME]" aria-hidden="true"></i>', text: '<span style="text-align: center;">[NAME]</span>', image: "<img src=[SRC] alt=[ALT] />", svg: '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">[PATH]</svg>' }, a.FE.ICONS = { bold: { NAME: "bold" }, italic: { NAME: "italic" }, underline: { NAME: "underline" }, strikeThrough: { NAME: "strikethrough" }, subscript: { NAME: "subscript" }, superscript: { NAME: "superscript" }, color: { NAME: "tint" }, outdent: { NAME: "outdent" }, indent: { NAME: "indent" }, undo: { NAME: "rotate-left" }, redo: { NAME: "rotate-right" }, insertHR: { NAME: "minus" }, clearFormatting: { NAME: "eraser" }, selectAll: { NAME: "mouse-pointer" } }, a.FE.DefineIconTemplate = function(b, c) { a.FE.ICON_TEMPLATES[b] = c }, a.FE.DefineIcon = function(b, c) { a.FE.ICONS[b] = c }, a.FE.MODULES.icon = function() {
        function b(b) { var c = null,
                d = a.FE.ICONS[b]; if ("undefined" != typeof d) { var e = d.template || a.FE.ICON_DEFAULT_TEMPLATE;
                e && (e = a.FE.ICON_TEMPLATES[e]) && (c = e.replace(/\[([a-zA-Z]*)\]/g, function(a, c) { return "NAME" == c ? d[c] || b : d[c] })) } return c || b }

        function c(b) { var c = a.FE.ICONS[b],
                d = a.FE.ICON_DEFAULT_TEMPLATE; return "undefined" != typeof c ? d = c.template || a.FE.ICON_DEFAULT_TEMPLATE : d } return { create: b, getTemplate: c } }, a.extend(a.FE.DEFAULTS, { tooltips: !0 }), a.FE.MODULES.tooltip = function(b) {
        function c() { return !b.helpers.isMobile() && void(b.$tooltip && b.$tooltip.removeClass("fr-visible").css("left", "-3000px").css("position", "fixed")) }

        function d(c, d) { if (b.helpers.isMobile()) return !1; if (c.data("title") || c.data("title", c.attr("title")), !c.data("title")) return !1;
            b.$tooltip || f(), c.removeAttr("title"), b.$tooltip.text(b.language.translate(c.data("title"))), b.$tooltip.addClass("fr-visible"); var e = c.offset().left + (c.outerWidth() - b.$tooltip.outerWidth()) / 2;
            e < 0 && (e = 0), e + b.$tooltip.outerWidth() > a(b.o_win).width() && (e = a(b.o_win).width() - b.$tooltip.outerWidth()), "undefined" == typeof d && (d = b.opts.toolbarBottom); var g = d ? c.offset().top - b.$tooltip.height() : c.offset().top + c.outerHeight();
            b.$tooltip.css("position", ""), b.$tooltip.css("left", e), b.$tooltip.css("top", Math.ceil(g)), "static" != a(b.o_doc).find("body:first").css("position") ? (b.$tooltip.css("margin-left", -a(b.o_doc).find("body:first").offset().left), b.$tooltip.css("margin-top", -a(b.o_doc).find("body:first").offset().top)) : (b.$tooltip.css("margin-left", ""), b.$tooltip.css("margin-top", "")) }

        function e(e, f, g) { b.opts.tooltips && !b.helpers.isMobile() && (b.events.$on(e, "mouseenter", f, function(c) { b.node.hasClass(c.currentTarget, "fr-disabled") || b.edit.isDisabled() || d(a(c.currentTarget), g) }, !0), b.events.$on(e, "mouseleave " + b._mousedown + " " + b._mouseup, f, function() { c() }, !0)) }

        function f() { b.opts.tooltips && !b.helpers.isMobile() && (b.shared.$tooltip ? b.$tooltip = b.shared.$tooltip : (b.shared.$tooltip = a('<div class="fr-tooltip"></div>'), b.$tooltip = b.shared.$tooltip, b.opts.theme && b.$tooltip.addClass(b.opts.theme + "-theme"), a(b.o_doc).find("body:first").append(b.$tooltip)), b.events.on("shared.destroy", function() { b.$tooltip.html("").removeData().remove(), b.$tooltip = null }, !0)) } return { hide: c, to: d, bind: e } }, a.FE.MODULES.button = function(b) {
        function c(b, c, d) { for (var e = a(), f = 0; f < b.length; f++) { var g = a(b[f]); if (g.is(c) && (e = e.add(g)), d && g.is(".fr-dropdown")) { var h = g.next().find(c);
                    e = e.add(h) } } return e }

        function d(d, e) { var f, g = a(); if (!d) return g;
            g = g.add(c(w, d, e)), g = g.add(c(x, d, e)); for (f in b.shared.popups)
                if (b.shared.popups.hasOwnProperty(f)) { var h = b.shared.popups[f],
                        i = h.children().find(d);
                    g = g.add(i) }
            for (f in b.shared.modals)
                if (b.shared.modals.hasOwnProperty(f)) { var j = b.shared.modals[f],
                        k = j.$modal.find(d);
                    g = g.add(k) }
            return g }

        function e(c) { var e = c.next(),
                f = b.node.hasClass(c.get(0), "fr-active"),
                g = d(".fr-dropdown.fr-active").not(c),
                h = c.parents(".fr-toolbar, .fr-popup").data("instance") || b; if (h.helpers.isIOS() && !h.el.querySelector(".fr-marker") && (h.selection.save(), h.selection.clear(), h.selection.restore()), !f) { var i = c.data("cmd");
                e.find(".fr-command").removeClass("fr-active").attr("aria-selected", !1), a.FE.COMMANDS[i] && a.FE.COMMANDS[i].refreshOnShow && a.FE.COMMANDS[i].refreshOnShow.apply(h, [c, e]), e.css("left", c.offset().left - c.parent().offset().left - ("rtl" == b.opts.direction ? e.width() - c.outerWidth() : 0)), e.addClass("test-height"); var j = e.outerHeight();
                e.removeClass("test-height"), e.css("top", "").css("bottom", ""), !b.opts.toolbarBottom && e.offset().top + c.outerHeight() + j < a(b.o_doc).height() ? e.css("top", c.position().top + c.outerHeight()) : e.css("bottom", c.parents(".fr-popup, .fr-toolbar").first().height() - c.position().top) } c.addClass("fr-blink").toggleClass("fr-active"), c.hasClass("fr-active") ? (e.attr("aria-hidden", !1), c.attr("aria-expanded", !0)) : (e.attr("aria-hidden", !0), c.attr("aria-expanded", !1)), setTimeout(function() { c.removeClass("fr-blink") }, 300), e.css("margin-left", ""), e.offset().left + e.outerWidth() > b.$sc.offset().left + b.$sc.width() && e.css("margin-left", -(e.offset().left + e.outerWidth() - b.$sc.offset().left - b.$sc.width())), e.offset().left < b.$sc.offset().left && "rtl" == b.opts.direction && e.css("margin-left", e.offset().left + e.outerWidth() - b.$sc.offset().left), g.removeClass("fr-active").attr("aria-expanded", !1).next().attr("aria-hidden", !0), g.parent(".fr-toolbar:not(.fr-inline)").css("zIndex", ""), 0 !== c.parents(".fr-popup").length || b.opts.toolbarInline || (b.node.hasClass(c.get(0), "fr-active") ? b.$tb.css("zIndex", (b.opts.zIndex || 1) + 4) : b.$tb.css("zIndex", "")); var k = e.find("a.fr-command.fr-active:first");
            b.helpers.isMobile() || (k.length ? b.accessibility.focusToolbarElement(k) : b.accessibility.focusToolbarElement(c)) }

        function f(a) { a.addClass("fr-blink"), setTimeout(function() { a.removeClass("fr-blink") }, 500); for (var b = a.data("cmd"), c = [];
                "undefined" != typeof a.data("param" + (c.length + 1));) c.push(a.data("param" + (c.length + 1))); var e = d(".fr-dropdown.fr-active");
            e.length && (e.removeClass("fr-active").attr("aria-expanded", !1).next().attr("aria-hidden", !0), e.parent(".fr-toolbar:not(.fr-inline)").css("zIndex", "")), a.parents(".fr-popup, .fr-toolbar").data("instance").commands.exec(b, c) }

        function g(a) { f(a) }

        function h(c) { var d = c.parents(".fr-popup, .fr-toolbar").data("instance"); if (0 !== c.parents(".fr-popup").length || c.data("popup") || d.popups.hideAll(), d.popups.areVisible() && !d.popups.areVisible(d)) { for (var f = 0; f < a.FE.INSTANCES.length; f++) a.FE.INSTANCES[f] != d && a.FE.INSTANCES[f].popups && a.FE.INSTANCES[f].popups.areVisible() && a.FE.INSTANCES[f].$el.find(".fr-marker").remove();
                d.popups.hideAll() } b.node.hasClass(c.get(0), "fr-dropdown") ? e(c) : (g(c), a.FE.COMMANDS[c.data("cmd")] && a.FE.COMMANDS[c.data("cmd")].refreshAfterCallback !== !1 && d.button.bulkRefresh()) }

        function i(b) { var c = a(b.currentTarget);
            h(c) }

        function j(a) { var b = a.find(".fr-dropdown.fr-active");
            b.length && (b.removeClass("fr-active").attr("aria-expanded", !1).next().attr("aria-hidden", !0), b.parent(".fr-toolbar:not(.fr-inline)").css("zIndex", "")) }

        function k(a) { a.preventDefault(), a.stopPropagation() }

        function l(a) {
            if (a.stopPropagation(), !b.helpers.isMobile()) return !1
        }

        function m(c, d) { b.events.bindClick(c, ".fr-command:not(.fr-disabled)", i), b.events.$on(c, b._mousedown + " " + b._mouseup + " " + b._move, ".fr-dropdown-menu", k, !0), b.events.$on(c, b._mousedown + " " + b._mouseup + " " + b._move, ".fr-dropdown-menu .fr-dropdown-wrapper", l, !0); var e = c.get(0).ownerDocument,
                f = "defaultView" in e ? e.defaultView : e.parentWindow,
                g = function(d) {
                    (!d || d.type == b._mouseup && d.target != a("html").get(0) || "keydown" == d.type && (b.keys.isCharacter(d.which) && !b.keys.ctrlKey(d) || d.which == a.FE.KEYCODE.ESC)) && j(c) };
            b.events.$on(a(f), b._mouseup + " resize keydown", g, !0), b.opts.iframe && b.events.$on(b.$win, b._mouseup, g, !0), b.node.hasClass(c.get(0), "fr-popup") ? a.merge(x, c.find(".fr-btn").toArray()) : a.merge(w, c.find(".fr-btn").toArray()), b.tooltip.bind(c, ".fr-btn, .fr-title", d) }

        function n(a, c) { var d = ""; if (c.html) d += "function" == typeof c.html ? c.html.call(b) : c.html;
            else { var e = c.options; "function" == typeof e && (e = e()), d += '<ul class="fr-dropdown-list" role="presentation">'; for (var f in e)
                    if (e.hasOwnProperty(f)) { var g = b.shortcuts.get(a + "." + f);
                        g = g ? '<span class="fr-shortcut">' + g + "</span>" : "", d += '<li role="presentation"><a class="fr-command" tabIndex="-1" role="option" data-cmd="' + a + '" data-param1="' + f + '" title="' + e[f] + '">' + b.language.translate(e[f]) + "</a></li>" }
                d += "</ul>" } return d }

        function o(a, c, d) { if (b.helpers.isMobile() && c.showOnMobile === !1) return ""; var e = c.displaySelection; "function" == typeof e && (e = e(b)); var f; if (e) { var g = "function" == typeof c.defaultSelection ? c.defaultSelection(b) : c.defaultSelection;
                f = '<span style="width:' + (c.displaySelectionWidth || 100) + 'px">' + b.language.translate(g || c.title) + "</span>" } else f = b.icon.create(c.icon || a), f += '<span class="fr-sr-only">' + (b.language.translate(c.title) || "") + "</span>"; var h = c.popup ? ' data-popup="true"' : "",
                i = c.modal ? ' data-modal="true"' : "",
                j = b.shortcuts.get(a + ".");
            j = j ? " (" + j + ")" : ""; var k = a + "-" + b.id,
                l = "dropdown-menu-" + k,
                m = '<button id="' + k + '"type="button" tabIndex="-1" role="button"' + (c.toggle ? ' aria-pressed="false"' : "") + ("dropdown" == c.type ? ' aria-controls="' + l + '" aria-expanded="false" aria-haspopup="true"' : "") + (c.disabled ? ' aria-disabled="true"' : "") + ' title="' + (b.language.translate(c.title) || "") + j + '" class="fr-command fr-btn' + ("dropdown" == c.type ? " fr-dropdown" : "") + (" fr-btn-" + b.icon.getTemplate(c.icon)) + (c.displaySelection ? " fr-selection" : "") + (c.back ? " fr-back" : "") + (c.disabled ? " fr-disabled" : "") + (d ? "" : " fr-hidden") + '" data-cmd="' + a + '"' + h + i + ">" + f + "</button>"; if ("dropdown" == c.type) { var o = '<div id="' + l + '" class="fr-dropdown-menu" role="listbox" aria-labelledby="' + k + '" aria-hidden="true"><div class="fr-dropdown-wrapper" role="presentation"><div class="fr-dropdown-content" role="presentation">';
                o += n(a, c), o += "</div></div></div>", m += o } return m }

        function p(c, d) { for (var e = "", f = 0; f < c.length; f++) { var g = c[f],
                    h = a.FE.COMMANDS[g]; if (!(h && "undefined" != typeof h.plugin && b.opts.pluginsEnabled.indexOf(h.plugin) < 0))
                    if (h) { var i = "undefined" == typeof d || d.indexOf(g) >= 0;
                        e += o(g, h, i) } else "|" == g ? e += '<div class="fr-separator fr-vs" role="separator" aria-orientation="vertical"></div>' : "-" == g && (e += '<div class="fr-separator fr-hs" role="separator" aria-orientation="horizontal"></div>') } return e }

        function q(c) { var d, e = c.parents(".fr-popup, .fr-toolbar").data("instance") || b,
                f = c.data("cmd");
            b.node.hasClass(c.get(0), "fr-dropdown") ? d = c.next() : (c.removeClass("fr-active"), c.attr("aria-pressed") && c.attr("aria-pressed", !1)), a.FE.COMMANDS[f] && a.FE.COMMANDS[f].refresh ? a.FE.COMMANDS[f].refresh.apply(e, [c, d]) : b.refresh[f] && e.refresh[f](c, d) }

        function r(c) { var d = b.$tb ? b.$tb.data("instance") || b : b; return b.events.trigger("buttons.refresh") === !1 || void setTimeout(function() { for (var e = d.selection.inEditor() && d.core.hasFocus(), f = 0; f < c.length; f++) { var g = a(c[f]),
                        h = g.data("cmd");
                    0 === g.parents(".fr-popup").length ? e || a.FE.COMMANDS[h] && a.FE.COMMANDS[h].forcedRefresh ? d.button.refresh(g) : b.node.hasClass(g.get(0), "fr-dropdown") || (g.removeClass("fr-active"), g.attr("aria-pressed") && g.attr("aria-pressed", !1)) : g.parents(".fr-popup").is(":visible") && d.button.refresh(g) } }, 0) }

        function s() { r(w), r(x) }

        function t() { w = [], x = [] }

        function u() { clearTimeout(y), y = setTimeout(s, 50) }

        function v() { b.opts.toolbarInline ? b.events.on("toolbar.show", s) : (b.events.on("mouseup", u), b.events.on("keyup", u), b.events.on("blur", u), b.events.on("focus", u), b.events.on("contentChanged", u), b.helpers.isMobile() && b.events.$on(b.$doc, "selectionchange", s)), b.events.on("shared.destroy", t) }
        var w = [];
        (b.opts.toolbarInline || b.opts.toolbarContainer) && (b.shared.buttons || (b.shared.buttons = []), w = b.shared.buttons);
        var x = [];
        b.shared.popup_buttons || (b.shared.popup_buttons = []), x = b.shared.popup_buttons;
        var y = null;
        return { _init: v, buildList: p, bindCommands: m, refresh: q, bulkRefresh: s, exec: f, click: h, hideActiveDropdowns: j, getButtons: d }
    }, a.FE.MODULES.modals = function(b) {
        function c(a) { return n[a] }

        function d(c, d) { var e = '<div tabIndex="-1" class="fr-modal' + (b.opts.theme ? " " + b.opts.theme + "-theme" : "") + '"><div class="fr-modal-wrapper">',
                f = '<i title="' + b.language.translate("Cancel") + '" class="fa fa-times fr-modal-close"></i>'; return e += '<div class="fr-modal-head">' + c + f + "</div>", e += '<div tabIndex="-1" class="fr-modal-body">' + d + "</div>", e += "</div></div>", a(e) }

        function e(c, e, f) { if (b.shared.$overlay || (b.shared.$overlay = a('<div class="fr-overlay">').appendTo("body:first")), m = b.shared.$overlay, b.opts.theme && m.addClass(b.opts.theme + "-theme"), !n[c]) { var g = d(e, f);
                n[c] = { $modal: g, $head: g.find(".fr-modal-head"), $body: g.find(".fr-modal-body") }, b.helpers.isMobile() || g.addClass("fr-desktop"), g.appendTo("body:first"), b.events.bindClick(g, "i.fr-modal-close", function() { h(c) }), n[c].$body.css("margin-top", n[c].$head.outerHeight()), b.events.$on(g, "keydown", function(d) { var e = d.which; return e == a.FE.KEYCODE.ESC ? (h(c), b.accessibility.focusModalButton(g), !1) : !(!a(d.currentTarget).is("input[type=text], textarea") && e != a.FE.KEYCODE.ARROW_UP && e != a.FE.KEYCODE.ARROW_DOWN && !b.keys.isBrowserAction(d)) || (d.preventDefault(), d.stopPropagation(), !1) }, !0), h(c, !0) } return n[c] }

        function f() { for (var a in n) { var b = n[a];
                b && b.$modal && b.$modal.removeData().remove() } m && m.removeData().remove(), n = {} }

        function g(c) { if (n[c]) { var d = n[c].$modal;
                d.data("instance", b), d.show(), m.show(), a(b.o_doc).find("body:first").addClass("prevent-scroll"), b.helpers.isMobile() && a(b.o_doc).find("body:first").addClass("fr-mobile"), d.addClass("fr-active"), b.accessibility.focusModal(d) } }

        function h(c, d) { if (n[c]) { var e = n[c].$modal,
                    f = e.data("instance") || b;
                f.events.enableBlur(), e.hide(), m.hide(), a(f.o_doc).find("body:first").removeClass("prevent-scroll fr-mobile"), e.removeClass("fr-active"), d || (b.accessibility.restoreSelection(f), b.events.trigger("modals.hide")) } }

        function i(c) { if (n[c]) { var d = n[c],
                    e = d.$modal,
                    f = d.$body,
                    g = a(b.o_win).height(),
                    h = e.find(".fr-modal-wrapper"),
                    i = h.outerHeight(!0),
                    j = h.height() - (f.outerHeight(!0) - f.height()),
                    k = g - i + j,
                    l = f.get(0).scrollHeight,
                    m = "auto";
                l > k && (m = k), f.height(m) } }

        function j(a) { var c; if ("string" == typeof a) { if (!n[a]) return;
                c = n[a].$modal } else c = a; return c && b.node.hasClass(c, "fr-active") && b.core.sameInstance(c) || !1 }

        function k(a) { for (var b in n)
                if (n.hasOwnProperty(b) && j(b) && ("undefined" == typeof a || n[b].$modal.data("instance") == a)) return n[b].$modal; return !1 }

        function l() { b.events.on("shared.destroy", f, !0) } b.shared.modals || (b.shared.modals = {}); var m, n = b.shared.modals; return { _init: l, get: c, create: e, show: g, hide: h, resize: i, isVisible: j, areVisible: k } }, a.FE.POPUP_TEMPLATES = { "text.edit": "[_EDIT_]" }, a.FE.RegisterTemplate = function(b, c) { a.FE.POPUP_TEMPLATES[b] = c }, a.FE.MODULES.popups = function(b) {
        function c(a, c) { c.is(":visible") || (c = b.$sc), c.is(x[a].data("container")) || (x[a].data("container", c), c.append(x[a])) }

        function d(a, d, e, h) { if (f(a) || (g() && b.$el.find(".fr-marker").length > 0 ? (b.events.disableBlur(), b.selection.restore()) : g() || (b.events.disableBlur(), b.events.focus(), b.events.enableBlur())), m([a]), !x[a]) return !1; var i = b.button.getButtons(".fr-dropdown.fr-active");
            i.removeClass("fr-active").attr("aria-expanded", !1).parent(".fr-toolbar").css("zIndex", ""), i.next().attr("aria-hidden", !0), x[a].data("instance", b), b.$tb && b.$tb.data("instance", b); var j = x[a].outerWidth(),
                k = f(a);
            x[a].addClass("fr-active").removeClass("fr-hidden").find("input, textarea").removeAttr("disabled"); var l = x[a].data("container");
            b.opts.toolbarInline && l && b.$tb && l.get(0) == b.$tb.get(0) && (c(a, b.$sc), e = b.$tb.offset().top - b.helpers.getPX(b.$tb.css("margin-top")), d = b.$tb.offset().left + b.$tb.outerWidth() / 2 + (parseFloat(b.$tb.find(".fr-arrow").css("margin-left")) || 0) + b.$tb.find(".fr-arrow").outerWidth() / 2, b.node.hasClass(b.$tb.get(0), "fr-above") && e && (e += b.$tb.outerHeight()), h = 0), l = x[a].data("container"), !b.opts.iframe || h || k || (d && (d -= b.$iframe.offset().left), e && (e -= b.$iframe.offset().top)), l.is(b.$tb) ? b.$tb.css("zIndex", (b.opts.zIndex || 1) + 4) : x[a].css("zIndex", (b.opts.zIndex || 1) + 4), d && (d -= j / 2), b.opts.toolbarBottom && l && b.$tb && l.get(0) == b.$tb.get(0) && (x[a].addClass("fr-above"), e && (e -= x[a].outerHeight())), x[a].removeClass("fr-active"), b.position.at(d, e, x[a], h || 0), x[a].addClass("fr-active"), k || b.accessibility.focusPopup(x[a]), b.opts.toolbarInline && b.toolbar.hide(), b.events.trigger("popups.show." + a), s(a)._repositionPopup(), o() }

        function e(a, c) { b.events.on("popups.show." + a, c) }

        function f(a) { return x[a] && b.node.hasClass(x[a], "fr-active") && b.core.sameInstance(x[a]) || !1 }

        function g(a) { for (var b in x)
                if (x.hasOwnProperty(b) && f(b) && ("undefined" == typeof a || x[b].data("instance") == a)) return x[b]; return !1 }

        function h(a) { var c = null;
            c = "string" != typeof a ? a : x[a], c && b.node.hasClass(c, "fr-active") && (c.removeClass("fr-active fr-above"), b.events.trigger("popups.hide." + a), b.$tb && (b.opts.zIndex > 1 ? b.$tb.css("zIndex", b.opts.zIndex + 1) : b.$tb.css("zIndex", "")), b.events.disableBlur(), c.find("input, textarea, button").filter(":focus").blur(), c.find("input, textarea").attr("disabled", "disabled")) }

        function i(a, c) { b.events.on("popups.hide." + a, c) }

        function j(a) { var c = x[a]; if (c && !c.data("inst" + b.id)) { var d = s(a);
                t(d, a) } return c }

        function k(a, c) { b.events.on("popups.refresh." + a, c) }

        function l(c) { x[c].data("instance", b), b.events.trigger("popups.refresh." + c); for (var d = x[c].find(".fr-command"), e = 0; e < d.length; e++) { var f = a(d[e]);
                0 === f.parents(".fr-dropdown-menu").length && b.button.refresh(f) } }

        function m(a) { "undefined" == typeof a && (a = []); for (var b in x) x.hasOwnProperty(b) && a.indexOf(b) < 0 && h(b) }

        function n() { b.shared.exit_flag = !0 }

        function o() { b.shared.exit_flag = !1 }

        function p() { return b.shared.exit_flag }

        function q(c, d) { var e = a.FE.POPUP_TEMPLATES[c]; "function" == typeof e && (e = e.apply(b)); for (var f in d) d.hasOwnProperty(f) && (e = e.replace("[_" + f.toUpperCase() + "_]", d[f])); return e }

        function r(c, d) { var e = q(c, d),
                f = a('<div class="fr-popup' + (b.helpers.isMobile() ? " fr-mobile" : " fr-desktop") + (b.opts.toolbarInline ? " fr-inline" : "") + '"><span class="fr-arrow"></span>' + e + "</div>");
            b.opts.theme && f.addClass(b.opts.theme + "-theme"), b.opts.zIndex > 1 && b.$tb.css("z-index", b.opts.zIndex + 2), "auto" != b.opts.direction && f.removeClass("fr-ltr fr-rtl").addClass("fr-" + b.opts.direction), f.find("input, textarea").attr("dir", b.opts.direction).attr("disabled", "disabled"); var g = a("body:first"); return g.append(f), f.data("container", g), x[c] = f, b.button.bindCommands(f, !1), f }

        function s(c) { var d = x[c]; return { _windowResize: function() { var a = d.data("instance") || b;!a.helpers.isMobile() && d.is(":visible") && (a.events.disableBlur(), a.popups.hide(c), a.events.enableBlur()) }, _inputFocus: function(c) { var e = d.data("instance") || b,
                        f = a(c.currentTarget); if (f.is("input:file") && f.closest(".fr-layer").addClass("fr-input-focus"), c.preventDefault(), c.stopPropagation(), setTimeout(function() { e.events.enableBlur() }, 100), e.helpers.isMobile()) { var g = a(e.o_win).scrollTop();
                        setTimeout(function() { a(e.o_win).scrollTop(g) }, 0) } }, _inputBlur: function(c) { var e = d.data("instance") || b,
                        f = a(c.currentTarget);
                    f.is("input:file") && f.closest(".fr-layer").removeClass("fr-input-focus"), document.activeElement != this && a(this).is(":visible") && (e.events.blurActive() && e.events.trigger("blur"), e.events.enableBlur()) }, _editorKeydown: function(e) { var g = d.data("instance") || b;
                    g.keys.ctrlKey(e) || e.which == a.FE.KEYCODE.ALT || e.which == a.FE.KEYCODE.ESC || (f(c) && d.find(".fr-back:visible").length ? g.button.exec(d.find(".fr-back:visible:first")) : e.which != a.FE.KEYCODE.ALT && g.popups.hide(c)) }, _preventFocus: function(c) { var e = d.data("instance") || b,
                        f = c.originalEvent ? c.originalEvent.target || c.originalEvent.originalTarget : null; "mouseup" == c.type || a(f).is(":focus") || e.events.disableBlur(), "mouseup" != c.type || a(f).hasClass("fr-command") || a(f).parents(".fr-command").length > 0 || b.button.hideActiveDropdowns(d), (b.browser.safari || b.browser.mozilla) && "mousedown" == c.type && a(f).is("input[type=file]") && e.events.disableBlur(); var g = "input, textarea, button, select, label, .fr-command"; return f && !a(f).is(g) && 0 === a(f).parents(g).length ? (c.stopPropagation(), !1) : (f && a(f).is(g) && c.stopPropagation(), void o()) }, _editorMouseup: function() { d.is(":visible") && p() && d.find("input:focus, textarea:focus, button:focus, select:focus").filter(":visible").length > 0 && b.events.disableBlur() }, _windowMouseup: function(a) { if (!b.core.sameInstance(d)) return !0; var e = d.data("instance") || b;
                    d.is(":visible") && p() && (a.stopPropagation(), e.markers.remove(), e.popups.hide(c), o()) }, _windowKeydown: function(e) { if (!b.core.sameInstance(d)) return !0; var f = d.data("instance") || b,
                        g = e.which; if (a.FE.KEYCODE.ESC == g) { if (f.popups.isVisible(c) && f.opts.toolbarInline) return e.stopPropagation(), f.popups.isVisible(c) && (d.find(".fr-back:visible").length ? (f.button.exec(d.find(".fr-back:visible:first")), f.accessibility.focusPopupButton(d)) : d.find(".fr-dismiss:visible").length ? f.button.exec(d.find(".fr-dismiss:visible:first")) : (f.popups.hide(c), f.toolbar.showInline(null, !0), f.accessibility.FocusPopupButton(d))), !1; if (f.popups.isVisible(c)) return d.find(".fr-back:visible").length ? (f.button.exec(d.find(".fr-back:visible:first")), f.accessibility.focusPopupButton(d)) : d.find(".fr-dismiss:visible").length ? f.button.exec(d.find(".fr-dismiss:visible:first")) : (f.popups.hide(c), f.accessibility.focusPopupButton(d)), !1 } }, _doPlaceholder: function() { var b = a(this).next();
                    0 === b.length && a(this).attr("placeholder") && a(this).after('<label for="' + a(this).attr("id") + '">' + a(this).attr("placeholder") + "</label>"), a(this).toggleClass("fr-not-empty", "" !== a(this).val()) }, _repositionPopup: function() { if (!b.opts.height && !b.opts.heightMax || b.opts.toolbarInline) return !0; if (b.$wp && f(c) && d.parent().get(0) == b.$sc.get(0)) { var a = d.offset().top - b.$wp.offset().top,
                            e = b.$wp.outerHeight();
                        b.node.hasClass(d.get(0), "fr-above") && (a += d.outerHeight()), a > e || a < 0 ? d.addClass("fr-hidden") : d.removeClass("fr-hidden") } } } }

        function t(a, c) { b.events.on("mouseup", a._editorMouseup, !0), b.$wp && b.events.on("keydown", a._editorKeydown), b.events.on("blur", function() { g() && b.markers.remove(), m() }), b.$wp && !b.helpers.isMobile() && b.events.$on(b.$wp, "scroll.popup" + c, a._repositionPopup), b.events.on("window.mouseup", a._windowMouseup, !0), b.events.on("window.keydown", a._windowKeydown, !0), x[c].data("inst" + b.id, !0), b.events.on("destroy", function() { b.core.sameInstance(x[c]) && x[c].removeClass("fr-active").appendTo("body:first") }, !0) }

        function u(c, d) { var e = r(c, d),
                f = s(c); return t(f, c), b.events.$on(e, "mousedown mouseup touchstart touchend touch", "*", f._preventFocus, !0), b.events.$on(e, "focus", "input, textarea, button, select", f._inputFocus, !0), b.events.$on(e, "blur", "input, textarea, button, select", f._inputBlur, !0), b.accessibility.registerPopup(c), b.events.$on(e, "keydown keyup change input", "input, textarea", f._doPlaceholder, !0), b.helpers.isIOS() && b.events.$on(e, "touchend", "label", function() { a("#" + a(this).attr("for")).prop("checked", function(a, b) { return !b }) }, !0), b.events.$on(a(b.o_win), "resize", f._windowResize, !0), e }

        function v() { for (var a in x)
                if (x.hasOwnProperty(a)) { var b = x[a];
                    b && (b.html("").removeData().remove(), x[a] = null) }
            x = [] }

        function w() { b.events.on("shared.destroy", v, !0), b.events.on("window.mousedown", n), b.events.on("window.touchmove", o), b.events.$on(a(b.o_win), "scroll", o), b.events.on("mousedown", function(a) { g() && (a.stopPropagation(), b.$el.find(".fr-marker").remove(), n(), b.events.disableBlur()) }) } b.shared.popups || (b.shared.popups = {}); var x = b.shared.popups; return b.shared.exit_flag = !1, { _init: w, create: u, get: j, show: d, hide: h, onHide: i, hideAll: m, setContainer: c, refresh: l, onRefresh: k, onShow: e, isVisible: f, areVisible: g } }, a.FE.MODULES.position = function(b) {
        function c() { var a = b.selection.ranges(0),
                c = a.getBoundingClientRect(); if (0 === c.top && 0 === c.left && 0 === c.width || 0 === c.height) { var d = !1;
                0 === b.$el.find(".fr-marker").length && (b.selection.save(), d = !0); var e = b.$el.find(".fr-marker:first");
                e.css("display", "inline"), e.css("line-height", ""); var f = e.offset(),
                    g = e.outerHeight();
                e.css("display", "none"), e.css("line-height", 0), c = {}, c.left = f.left, c.width = 0, c.height = g, c.top = f.top - (b.helpers.isMobile() && !b.helpers.isIOS() ? 0 : b.helpers.scrollTop()), c.right = 1, c.bottom = 1, c.ok = !0, d && b.selection.restore() } return c }

        function d(a, c, d) { var e = a.outerHeight(!0); if (!b.helpers.isMobile() && b.$tb && a.parent().get(0) != b.$tb.get(0)) { var f = a.parent().offset().top,
                    g = c - e - (d || 0);
                a.parent().get(0) == b.$sc.get(0) && (f -= a.parent().position().top); var h = b.$sc.get(0).clientHeight;
                f + c + e > b.$sc.offset().top + h && a.parent().offset().top + g > 0 && g > 0 ? (c = g, a.addClass("fr-above")) : a.removeClass("fr-above") } return c }

        function e(a, c) { var d = a.outerWidth(!0); return c + d > b.$sc.get(0).clientWidth - 10 && (c = b.$sc.get(0).clientWidth - d - 10), c < 0 && (c = 10), c }

        function f(a) { var d = c();
            a.css({ top: 0, left: 0 }); var e = d.top + d.height,
                f = d.left + d.width / 2 - a.get(0).offsetWidth / 2 + b.helpers.scrollLeft();
            b.opts.iframe || (e += b.helpers.scrollTop()), g(f, e, a, d.height) }

        function g(a, c, f, g) { var h = f.data("container");!h || "BODY" === h.get(0).tagName && "static" == h.css("position") || (a && (a -= h.offset().left), c && (c -= h.offset().top), "BODY" != h.get(0).tagName ? (a && (a += h.get(0).scrollLeft), c && (c += h.get(0).scrollTop)) : "absolute" == h.css("position") && (a && (a += h.position().left), c && (c += h.position().top))), b.opts.iframe && h && b.$tb && h.get(0) != b.$tb.get(0) && (a && (a += b.$iframe.offset().left), c && (c += b.$iframe.offset().top)); var i = e(f, a); if (a) { f.css("left", i); var j = f.data("fr-arrow");
                j || (j = f.find(".fr-arrow"), f.data("fr-arrow", j)), j.data("margin-left") || j.data("margin-left", b.helpers.getPX(j.css("margin-left"))), j.css("margin-left", a - i + j.data("margin-left")) } c && f.css("top", d(f, c, g)) }

        function h(c) { var d = a(c),
                e = d.is(".fr-sticky-on"),
                f = d.data("sticky-top"),
                g = d.data("sticky-scheduled"); if ("undefined" == typeof f) { d.data("sticky-top", 0); var h = a('<div class="fr-sticky-dummy" style="height: ' + d.outerHeight() + 'px;"></div>');
                b.$box.prepend(h) } else b.$box.find(".fr-sticky-dummy").css("height", d.outerHeight()); if (b.core.hasFocus() || b.$tb.find("input:visible:focus").length > 0) { var i = b.helpers.scrollTop(),
                    j = Math.min(Math.max(i - b.$tb.parent().offset().top, 0), b.$tb.parent().outerHeight() - d.outerHeight());
                j != f && j != g && (clearTimeout(d.data("sticky-timeout")), d.data("sticky-scheduled", j), d.outerHeight() < i - b.$tb.parent().offset().top && d.addClass("fr-opacity-0"), d.data("sticky-timeout", setTimeout(function() { var a = b.helpers.scrollTop(),
                        c = Math.min(Math.max(a - b.$tb.parent().offset().top, 0), b.$tb.parent().outerHeight() - d.outerHeight());
                    c > 0 && "BODY" == b.$tb.parent().get(0).tagName && (c += b.$tb.parent().position().top), c != f && (d.css("top", Math.max(c, 0)), d.data("sticky-top", c), d.data("sticky-scheduled", c)), d.removeClass("fr-opacity-0") }, 100))), e || (d.css("top", "0"), d.width(b.$tb.parent().width()), d.addClass("fr-sticky-on"), b.$box.addClass("fr-sticky-box")) } else clearTimeout(a(c).css("sticky-timeout")), d.css("top", "0"), d.css("position", ""), d.width(""), d.data("sticky-top", 0), d.removeClass("fr-sticky-on"), b.$box.removeClass("fr-sticky-box") }

        function i(c) { if (c.offsetWidth) { var d, e, f = a(c),
                    g = f.outerHeight(),
                    h = f.data("sticky-position"),
                    i = a("body" == b.opts.scrollableContainer ? b.o_win : b.opts.scrollableContainer).outerHeight(),
                    j = 0,
                    k = 0; "body" !== b.opts.scrollableContainer && (j = b.$sc.offset().top, k = a(b.o_win).outerHeight() - j - i); var l = "body" == b.opts.scrollableContainer ? b.helpers.scrollTop() : j,
                    m = f.is(".fr-sticky-on");
                f.data("sticky-parent") || f.data("sticky-parent", f.parent()); var n = f.data("sticky-parent"),
                    o = n.offset().top,
                    p = n.outerHeight(); if (f.data("sticky-offset") ? b.$box.find(".fr-sticky-dummy").css("height", g + "px") : (f.data("sticky-offset", !0), f.after('<div class="fr-sticky-dummy" style="height: ' + g + 'px;"></div>')), !h) { var q = "auto" !== f.css("top") || "auto" !== f.css("bottom");
                    q || f.css("position", "fixed"), h = { top: b.node.hasClass(f.get(0), "fr-top"), bottom: b.node.hasClass(f.get(0), "fr-bottom") }, q || f.css("position", ""), f.data("sticky-position", h), f.data("top", b.node.hasClass(f.get(0), "fr-top") ? f.css("top") : "auto"), f.data("bottom", b.node.hasClass(f.get(0), "fr-bottom") ? f.css("bottom") : "auto") } var r = function() { return o < l + d && o + p - g >= l + d },
                    s = function() { return o + g < l + i - e && o + p > l + i - e };
                d = b.helpers.getPX(f.data("top")), e = b.helpers.getPX(f.data("bottom")); var t = h.top && r() && b.helpers.isInViewPort(b.$sc.get(0)),
                    u = h.bottom && s();
                t || u ? (f.css("width", n.get(0).getBoundingClientRect().width + "px"), m || (f.addClass("fr-sticky-on"), f.removeClass("fr-sticky-off"), f.css("top") && ("auto" != f.data("top") ? f.css("top", b.helpers.getPX(f.data("top")) + j) : f.data("top", "auto")), f.css("bottom") && ("auto" != f.data("bottom") ? f.css("bottom", b.helpers.getPX(f.data("bottom")) + k) : f.css("bottom", "auto")))) : b.node.hasClass(f.get(0), "fr-sticky-off") || (f.width(""), f.removeClass("fr-sticky-on"), f.addClass("fr-sticky-off"), f.css("top") && "auto" != f.data("top") && h.top && f.css("top", 0), f.css("bottom") && "auto" != f.data("bottom") && h.bottom && f.css("bottom", 0)) } }

        function j() { var a = document.createElement("test"),
                c = a.style; return c.cssText = "position:" + ["-webkit-", "-moz-", "-ms-", "-o-", ""].join("sticky; position:") + " sticky;", c.position.indexOf("sticky") !== -1 && !b.helpers.isIOS() && !b.helpers.isAndroid() && !b.browser.chrome }

        function k() { if (!j())
                if (b._stickyElements = [], b.helpers.isIOS()) { var c = function() { b.helpers.requestAnimationFrame()(c); for (var a = 0; a < b._stickyElements.length; a++) h(b._stickyElements[a]) };
                    c(), b.events.$on(a(b.o_win), "scroll", function() { if (b.core.hasFocus())
                            for (var c = 0; c < b._stickyElements.length; c++) { var d = a(b._stickyElements[c]),
                                    e = d.parent(),
                                    f = b.helpers.scrollTop();
                                d.outerHeight() < f - e.offset().top && (d.addClass("fr-opacity-0"), d.data("sticky-top", -1), d.data("sticky-scheduled", -1)) } }, !0) } else "body" !== b.opts.scrollableContainer && b.events.$on(a(b.opts.scrollableContainer), "scroll", l, !0), b.events.$on(a(b.o_win), "scroll", l, !0), b.events.$on(a(b.o_win), "resize", l, !0), b.events.on("initialized", l), b.events.on("focus", l), b.events.$on(a(b.o_win), "resize", "textarea", l, !0);
            b.events.on("destroy", function() { b._stickyElements = [] }) }

        function l() { if (b._stickyElements)
                for (var a = 0; a < b._stickyElements.length; a++) i(b._stickyElements[a]) }

        function m(a) { a.addClass("fr-sticky"), b.helpers.isIOS() && a.addClass("fr-sticky-ios"), j() || (a.removeClass("fr-sticky"), b._stickyElements.push(a.get(0))) }

        function n() { k() } return { _init: n, forSelection: f, addSticky: m, refresh: l, at: g, getBoundingRect: c } }, a.FE.MODULES.refresh = function(b) {
        function c(a) { g(a, !b.undo.canDo()) }

        function d(a) { g(a, !b.undo.canRedo()) }

        function e(a) { if (b.node.hasClass(a.get(0), "fr-no-refresh")) return !1; for (var c = b.selection.blocks(), d = 0; d < c.length; d++) { for (var e = c[d].previousSibling; e && e.nodeType == Node.TEXT_NODE && 0 === e.textContent.length;) e = e.previousSibling; if ("LI" != c[d].tagName || e) return g(a, !1), !0;
                g(a, !0) } }

        function f(c) { if (b.node.hasClass(c.get(0), "fr-no-refresh")) return !1; for (var d = b.selection.blocks(), e = 0; e < d.length; e++) { var f = "rtl" == b.opts.direction || "rtl" == a(d[e]).css("direction") ? "margin-right" : "margin-left"; if ("LI" == d[e].tagName || "LI" == d[e].parentNode.tagName) return g(c, !1), !0; if (b.helpers.getPX(a(d[e]).css(f)) > 0) return g(c, !1), !0 } g(c, !0) }

        function g(a, b) { a.toggleClass("fr-disabled", b).attr("aria-disabled", b) } return { undo: c, redo: d, outdent: f, indent: e } }, a.extend(a.FE.DEFAULTS, { editInPopup: !1 }), a.FE.MODULES.textEdit = function(a) {
        function b() { var b = '<div id="fr-text-edit-' + a.id + '" class="fr-layer fr-text-edit-layer"><div class="fr-input-line"><input type="text" placeholder="' + a.language.translate("Text") + '" tabIndex="1"></div><div class="fr-action-buttons"><button type="button" class="fr-command fr-submit" data-cmd="updateText" tabIndex="2">' + a.language.translate("Update") + "</button></div></div>",
                c = { edit: b };
            a.popups.create("text.edit", c) }

        function c() { var b, c = a.popups.get("text.edit");
            b = "INPUT" === a.$el.prop("tagName") ? a.$el.attr("placeholder") : a.$el.text(), c.find("input").val(b).trigger("change"), a.popups.setContainer("text.edit", a.$sc), a.popups.show("text.edit", a.$el.offset().left + a.$el.outerWidth() / 2, a.$el.offset().top + a.$el.outerHeight(), a.$el.outerHeight()) }

        function d() { a.events.$on(a.$el, a._mouseup, function() { setTimeout(function() { c() }, 10) }) }

        function e() { var b = a.popups.get("text.edit"),
                c = b.find("input").val();
            0 === c.length && (c = a.opts.placeholderText), "INPUT" === a.$el.prop("tagName") ? a.$el.attr("placeholder", c) : a.$el.text(c), a.events.trigger("contentChanged"), a.popups.hide("text.edit") }

        function f() { a.opts.editInPopup && (b(), d()) } return { _init: f, update: e } }, a.FE.RegisterCommand("updateText", { focus: !1, undo: !1, callback: function() { this.textEdit.update() } }), a.extend(a.FE.DEFAULTS, { toolbarBottom: !1, toolbarButtons: ["fullscreen", "bold", "italic", "underline", "strikeThrough", "subscript", "superscript", "|", "fontFamily", "fontSize", "color", "inlineStyle", "paragraphStyle", "|", "paragraphFormat", "align", "formatOL", "formatUL", "outdent", "indent", "quote", "-", "insertLink", "insertImage", "insertVideo", "embedly", "insertFile", "insertTable", "|", "emoticons", "specialCharacters", "insertHR", "selectAll", "clearFormatting", "|", "print", "spellChecker", "help", "html", "|", "undo", "redo"], toolbarButtonsXS: ["bold", "italic", "fontFamily", "fontSize", "|", "undo", "redo"], toolbarButtonsSM: ["bold", "italic", "underline", "|", "fontFamily", "fontSize", "insertLink", "insertImage", "table", "|", "undo", "redo"], toolbarButtonsMD: null, toolbarContainer: null, toolbarInline: !1, toolbarSticky: !0, toolbarStickyOffset: 0, toolbarVisibleWithoutSelection: !1 }), a.FE.MODULES.toolbar = function(b) {
        function c(a, b) { for (var c = 0; c < b.length; c++) "-" != b[c] && "|" != b[c] && a.indexOf(b[c]) < 0 && a.push(b[c]) }

        function d() { var d = a.merge([], e());
            c(d, b.opts.toolbarButtonsXS || []), c(d, b.opts.toolbarButtonsSM || []), c(d, b.opts.toolbarButtonsMD || []), c(d, b.opts.toolbarButtons); for (var f = d.length - 1; f >= 0; f--) "-" != d[f] && "|" != d[f] && d.indexOf(d[f]) < f && d.splice(f, 1); var g = b.button.buildList(d, e());
            b.$tb.append(g), b.button.bindCommands(b.$tb) }

        function e() { var a = b.helpers.screenSize(); return v[a] }

        function f() { var a = e();
            b.$tb.find(".fr-separator").remove(), b.$tb.find("> .fr-command").addClass("fr-hidden"); for (var c = 0; c < a.length; c++)
                if ("|" == a[c] || "-" == a[c]) b.$tb.append(b.button.buildList([a[c]]));
                else { var d = b.$tb.find('> .fr-command[data-cmd="' + a[c] + '"]'),
                        f = null;
                    b.node.hasClass(d.next().get(0), "fr-dropdown-menu") && (f = d.next()), d.removeClass("fr-hidden").appendTo(b.$tb), f && f.appendTo(b.$tb) } }

        function g() { b.events.$on(a(b.o_win), "resize", f), b.events.$on(a(b.o_win), "orientationchange", f) }

        function h(c, d) { setTimeout(function() { if ((!c || c.which != a.FE.KEYCODE.ESC) && b.selection.inEditor() && b.core.hasFocus() && !b.popups.areVisible() && (b.opts.toolbarVisibleWithoutSelection || !b.selection.isCollapsed() && !b.keys.isIME() || d)) { if (b.$tb.data("instance", b), b.events.trigger("toolbar.show", [c]) === !1) return !1;
                    b.$tb.show(), b.opts.toolbarContainer || b.position.forSelection(b.$tb), b.opts.zIndex > 1 ? b.$tb.css("z-index", b.opts.zIndex + 1) : b.$tb.css("z-index", null) } }, 0) }

        function i(a) { if (a && "blur" === a.type && document.activeElement === b.el) return !1; if (a && "keydown" === a.type && b.keys.ctrlKey(a)) return !0; var c = b.button.getButtons(".fr-dropdown.fr-active"); return !!c.next().find(b.o_doc.activeElement).length || void(b.events.trigger("toolbar.hide") !== !1 && b.$tb.hide()) }

        function j() { return b.events.trigger("toolbar.show") !== !1 && void b.$tb.show() }

        function k(c) { clearTimeout(w), c && c.which == a.FE.KEYCODE.ESC || (w = setTimeout(h, b.opts.typingTimer)) }

        function l() { b.events.on("window.mousedown", i), b.events.on("keydown", i), b.events.on("blur", i), b.events.on("window.mouseup", h), b.helpers.isMobile() ? b.helpers.isIOS() || (b.events.on("window.touchend", h), b.browser.mozilla && setInterval(h, 200)) : b.events.on("window.keyup", k), b.events.on("keydown", function(b) { b && b.which == a.FE.KEYCODE.ESC && i() }), b.events.on("keydown", function(b) { if (b.which == a.FE.KEYCODE.ALT) return b.stopPropagation(), !1 }, !0), b.events.$on(b.$wp, "scroll.toolbar", h), b.events.on("commands.after", h), b.helpers.isMobile() && (b.events.$on(b.$doc, "selectionchange", k), b.events.$on(b.$doc, "orientationchange", h)) }

        function m() { b.opts.toolbarInline ? (b.$sc.append(b.$tb), b.$tb.data("container", b.$sc), b.$tb.addClass("fr-inline"), b.$tb.prepend('<span class="fr-arrow"></span>'), l(), b.opts.toolbarBottom = !1) : (b.opts.toolbarBottom && !b.helpers.isIOS() ? (b.$box.append(b.$tb), b.$tb.addClass("fr-bottom"), b.$box.addClass("fr-bottom")) : (b.opts.toolbarBottom = !1, b.$box.prepend(b.$tb), b.$tb.addClass("fr-top"), b.$box.addClass("fr-top")), b.$tb.addClass("fr-basic"), b.opts.toolbarSticky && (b.opts.toolbarStickyOffset && (b.opts.toolbarBottom ? b.$tb.css("bottom", b.opts.toolbarStickyOffset) : b.$tb.css("top", b.opts.toolbarStickyOffset)), b.position.addSticky(b.$tb))) }

        function n() { b.$tb.html("").removeData().remove(), b.$tb = null }

        function o() { b.$box.removeClass("fr-top fr-bottom fr-inline fr-basic"), b.$box.find(".fr-sticky-dummy").remove() }

        function p() { b.opts.theme && b.$tb.addClass(b.opts.theme + "-theme"), b.opts.zIndex > 1 && b.$tb.css("z-index", b.opts.zIndex + 1), "auto" != b.opts.direction && b.$tb.removeClass("fr-ltr fr-rtl").addClass("fr-" + b.opts.direction), b.helpers.isMobile() ? b.$tb.addClass("fr-mobile") : b.$tb.addClass("fr-desktop"), b.opts.toolbarContainer ? (b.opts.toolbarInline && (l(), i()), b.opts.toolbarBottom ? b.$tb.addClass("fr-bottom") : b.$tb.addClass("fr-top")) : m(), t = b.$tb.get(0).ownerDocument, u = "defaultView" in t ? t.defaultView : t.parentWindow, d(), g(), b.accessibility.registerToolbar(b.$tb), b.events.$on(b.$tb, b._mousedown + " " + b._mouseup, function(a) { var c = a.originalEvent ? a.originalEvent.target || a.originalEvent.originalTarget : null; if (c && "INPUT" != c.tagName && !b.edit.isDisabled()) return a.stopPropagation(), a.preventDefault(), !1 }, !0) }

        function q() { return b.$sc = a(b.opts.scrollableContainer).first(), !!b.$wp && (b.opts.toolbarContainer ? (b.shared.$tb ? (b.$tb = b.shared.$tb, b.opts.toolbarInline && l()) : (b.shared.$tb = a('<div class="fr-toolbar"></div>'), b.$tb = b.shared.$tb, a(b.opts.toolbarContainer).append(b.$tb), p(), b.$tb.data("instance", b)), b.opts.toolbarInline ? b.$box.addClass("fr-inline") : b.$box.addClass("fr-basic"), b.events.on("focus", function() { b.$tb.data("instance", b) }, !0), b.opts.toolbarInline = !1) : b.opts.toolbarInline ? (b.$box.addClass("fr-inline"), b.shared.$tb ? (b.$tb = b.shared.$tb, l()) : (b.shared.$tb = a('<div class="fr-toolbar"></div>'), b.$tb = b.shared.$tb, p())) : (b.$box.addClass("fr-basic"), b.$tb = a('<div class="fr-toolbar"></div>'), p(), b.$tb.data("instance", b)), b.events.on("destroy", o, !0), void b.events.on(b.opts.toolbarInline || b.opts.toolbarContainer ? "shared.destroy" : "destroy", n, !0)) }

        function r() {!x && b.$tb && (b.$tb.find("> .fr-command").addClass("fr-disabled fr-no-refresh").attr("aria-disabled", !0), x = !0) }

        function s() { x && b.$tb && (b.$tb.find("> .fr-command").removeClass("fr-disabled fr-no-refresh").attr("aria-disabled", !1), x = !1), b.button.bulkRefresh() } var t, u, v = [];
        v[a.FE.XS] = b.opts.toolbarButtonsXS || b.opts.toolbarButtons, v[a.FE.SM] = b.opts.toolbarButtonsSM || b.opts.toolbarButtons, v[a.FE.MD] = b.opts.toolbarButtonsMD || b.opts.toolbarButtons, v[a.FE.LG] = b.opts.toolbarButtons; var w = null,
            x = !1; return { _init: q, hide: i, show: j, showInline: h, disable: r, enable: s } }
});