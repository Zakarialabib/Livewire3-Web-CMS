import EditorJS from '@editorjs/editorjs';
import ImageTool from '@editorjs/image';
import Header from '@editorjs/header';
import Underline from '@editorjs/underline';
import Code from '@editorjs/code';
import InlineCode from '@editorjs/inline-code';
import Quote from '@editorjs/quote';
import List from '@editorjs/list';
import AnyButton from 'editorjs-button';
import ColorPlugin from 'editorjs-text-color-plugin';
// import NestedList from '@editorjs/nested-list';
import Table from '@editorjs/table';
import Delimiter from '@editorjs/delimiter';
import Paragraph from 'editorjs-paragraph-with-alignment';
import Undo from 'editorjs-undo';
import DragDrop from 'editorjs-drag-drop';
import Hyperlink from 'editorjs-hyperlink';
import AlignmentTuneTool from 'editorjs-text-alignment-blocktune';
import Raw from '@editorjs/raw';
import Link from '@editorjs/link';
import Alert from 'editorjs-alert';

window.editorInstance = function(dataProperty, editorId, readOnly, placeholder, logLevel) {
    return {
        instance: null,
        data: null,

        initEditor() {
            this.data = this.$wire.$get(dataProperty);

            this.instance = new EditorJS({
                onReady: () => {
                    new Undo({ editor: this.instance });
                    new DragDrop(this.instance);
                },
                holder: editorId,

                readOnly,

                placeholder,

                logLevel,

                tools: {
                    image: {
                        class: ImageTool,

                        config: {
                            uploader: {
                                uploadByFile: (file) => {
                                    return new Promise((resolve) => {
                                        this.$wire.upload(
                                            'uploads',
                                            file,
                                            (uploadedFilename) => {
                                                const eventName = `fileupload:${uploadedFilename.substr(0, 20)}`;

                                                const storeListener = (event) => {
                                                    resolve({
                                                        success: 1,
                                                        file: {
                                                            url: event.detail.url
                                                        }
                                                    });

                                                    window.removeEventListener(eventName, storeListener);
                                                };

                                                window.addEventListener(eventName, storeListener);

                                                this.$wire.call('completedImageUpload', uploadedFilename, eventName);
                                            }
                                        );
                                    });
                                },

                                uploadByUrl: (url) => {
                                    return this.$wire.loadImageFromUrl(url).then(result => {
                                        return {
                                            success: 1,
                                            file: {
                                                url: result
                                            }
                                        }
                                    });
                                }
                            }
                        }
                    },
                    list: List,
                    header: Header,
                    underline: Underline,
                    code: Code,
                    table: {
                        class: Table,
                        inlineToolbar: true,
                        config: {
                            rows: 2,
                            cols: 3,
                        },
                    },
                    raw: Raw,
                    quote: Quote,
                    paragraph: {
                        class: Paragraph,
                        inlineToolbar: true,
                        tunes: ['alignmentTune'],
                    },
                    marker: {
                        class: ColorPlugin,
                        config: {
                            defaultColor: '#FFBF00',
                            type: 'marker',
                            customPicker: true,
                        }
                    },
                    delimiter: Delimiter,
                    AnyButton: {
                        class: AnyButton,
                        inlineToolbar: true,
                        shortcut: 'CMD+SHIFT+B',
                        config: {
                            css: {
                                "btnColor": "btn--default",
                            }
                        }
                    },
                    inlineCode: InlineCode,
                    Color: {
                        class: ColorPlugin,
                        config: {
                            colorCollections: ['#EC7878', '#9C27B0', '#673AB7', '#3F51B5', '#0070FF', '#03A9F4', '#00BCD4', '#4CAF50', '#8BC34A', '#CDDC39', '#FFF'],
                            defaultColor: '#FF1300',
                            type: 'text',
                            customPicker: true,
                        }
                    },
                    link: Link,
                    hyperlink: {
                        class: Hyperlink,
                        config: {
                            shortcut: 'CMD+L',
                            target: '_blank',
                            rel: 'nofollow',
                            availableTargets: ['_blank', '_self'],
                            availableRels: ['author', 'noreferrer'],
                            validate: false,
                        }
                    },
                    underline: Underline,
                    alignmentTune: {
                        class: AlignmentTuneTool,
                        config: {
                            default: "left",
                            blocks: {
                                header: 'left',
                                list: 'left'
                            }
                        },
                    },
                    alert: {
                        class: Alert,
                        inlineToolbar: true,
                        shortcut: "CMD+SHIFT+A",
                        config: {
                            defaultType: "primary",
                            messagePlaceholder: "Enter something",
                        },
                    }
                },

                data: this.data,

                onChange: () => {
                    this.instance.save().then((outputData) => {
                        this.$wire.$set(dataProperty, outputData);

                        this.$wire.$call('save');
                    }).catch((error) => {
                        console.log('Saving failed: ', error)
                    });
                }
            });
        }
    }
}