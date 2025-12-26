/**
 * @file Stickers plugin for CKEditor 4
 */

(function() {
    'use strict';

    CKEDITOR.plugins.add('stickers', {
        requires: 'dialog',
        lang: 'ko,en',
        icons: 'stickers',
        hidpi: true,

        init: function(editor) {
            // 🎯 CSS 파일 로드 확인
            CKEDITOR.document.appendStyleSheet(this.path + 'styles/dialog.css');

            // 다이얼로그 등록
            CKEDITOR.dialog.add('stickersDialog', this.path + 'dialogs/stickers.js');

            // 스티커 삽입 커맨드 등록
            editor.addCommand('insertSticker', new CKEDITOR.dialogCommand('stickersDialog'));

            // 툴바 버튼 추가
            editor.ui.addButton('Stickers', {
                label: '스티커스',
                command: 'insertSticker',
                toolbar: 'insert',
                icon: this.path + 'icons/stickers.png'
            });

            // 컨텍스트 메뉴 지원 (선택사항)
            if (editor.contextMenu) {
                editor.addMenuGroup('stickersGroup');
                editor.addMenuItem('stickersItem', {
                    label: editor.lang.stickers.menu,
                    icon: this.path + 'icons/stickers.png',
                    command: 'insertSticker',
                    group: 'stickersGroup'
                });

                editor.contextMenu.addListener(function(element) {
                    return { stickersItem: CKEDITOR.TRISTATE_OFF };
                });
            }
        }
    });
})();