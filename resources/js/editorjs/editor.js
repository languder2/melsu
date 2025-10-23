import EditorJS from '@editorjs/editorjs';
import Header from '@editorjs/header';
import LinkTool from '@editorjs/link';
import ImageTool from '@editorjs/image';

import Sortable from 'sortablejs';
import ImageGallery from '@kiberpro/editorjs-gallery';
import RawTool from '@editorjs/raw';
import EditorJSList from '@editorjs/list';
import Embed from '@editorjs/embed';
import Quote from '@editorjs/quote';
import Table from '@editorjs/table';
import Hr from '@ignweb/hr-tool';
import AttachesTool from '@editorjs/attaches';
import CodeTool from '@editorjs/code';
import Paragraph from 'editorjs-paragraph-with-alignment';
import BackgroundTune from 'editorjs-background';

// import ToggleBlock from 'editorjs-toggle-block';
import Columns from '@calumk/editorjs-columns';
import Accordion from 'editorjs-collapsible-block';

let initialShortData = { blocks: [] };
let ShortBlock = document.getElementById('EditorJSShortBlock');

if(ShortBlock && ShortBlock.dataset.initialContent)
    initialShortData = JSON.parse(ShortBlock.dataset.initialContent);

const editorShort = new EditorJS({
    holder: 'EditorJSShortBlock',
    data: initialShortData,
    placeholder: 'Напишите краткое описание',
    tools: {
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
        },
        raw: RawTool,
        attaches: {
            class: AttachesTool,
            config: {
                endpoint: 'http://localhost:8008/uploadFile'
            }
        }
    }
});


let initialContentData = { blocks: [] };
let contentBlock = document.getElementById('editorJSContentBlock');

if(contentBlock && contentBlock.dataset.initialContent)
    initialContentData = JSON.parse(contentBlock.dataset.initialContent);

const editor = new EditorJS({
    holder: 'editorJSContentBlock',
    data: initialContentData,
    placeholder: 'Введите содержание новости',
    tools: {
        paragraph: {
            class: Paragraph,
            inlineToolbar: true,
        },
        code: CodeTool,
        header: {
            class: Header,
            inlineToolbar: ['link']
        },
        // toggle: {
        //     class: ToggleBlock,
        //     inlineToolbar: true,
        // },
        linkTool: {
            class: LinkTool,
            config: {
                endpoint: '/api/fetchUrl',
            }
        },
        backgroundTune: {
            class: BackgroundTune,
            config: {
                colors: [
                    {
                        id: 'info',
                        icon: '<svg></svg>',
                        title: 'Info',
                        color: 'rgba(92, 182, 255, 0.1)'
                    },
                    {
                        id: 'warning',
                        icon: '<svg></svg>',
                        title: 'Warning',
                        color: 'rgba(255, 208, 37, 0.1)'
                    }
                ]
            },
        },
        image: {
            class: ImageTool,
            config: {
                width: 1200,
                uploader: {
                    uploadByFile(file){
                        const formData = new FormData();
                        formData.append('image', file);

                        return fetch('/api/upload-image', { // <-- ВАШ URL для загрузки
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                            },
                            body: formData
                        })
                            .then(response => response.json())
                            .then(data => {
                                return data;
                            })
                            .catch(error => {
                                console.error('Ошибка загрузки изображения:', error);
                                return {
                                    success: 0,
                                    file: {
                                        url: null
                                    }
                                };
                            });
                    },

                    uploadByUrl(url) {
                        return fetch('/api/fetch-image', {});
                    }
                }
            }
        },
        gallery: {
            class: ImageGallery,
            config: {
                sortableJs: Sortable,
                endpoints: {
                    byFile: '/api/upload-image',
                },
                maxElementCount: 20,
            },
        },
        embed: Embed,
        quote: Quote,
        List: {
            class: EditorJSList,
            inlineToolbar: true,
            config: {
                defaultStyle: 'unordered'
            },
        },
        table: Table,
        hr: Hr,
        // columns: {
        //     class: Columns,
        //     config: {
        //         EditorJsLibrary: EditorJS,
        //         tools: {
        //             header: Header
        //         }
        //     }
        // },
        // accordion: {
        //     class: Accordion,
        //     // optional config
        //     config: {
        //         defaultExpanded: true,
        //         maxBlockCount: 10,
        //         disableAnimation: false,
        //         overrides: {
        //             styles: {
        //                 blockWrapper: 'background-color: lightyellow;',
        //                 blockContent: 'border-left: 2px solid #ccc;',
        //                 lastBlockContent: 'border-bottom: 2px solid #ccc;',
        //                 insideContent: 'padding: 10px;',
        //             },
        //         },
        //     },
        // },
        raw: RawTool,
    },
    tunes: ['backgroundTune']
});


const form = document.getElementById('formWithEditorJS');

form.addEventListener('submit', (evt) => {

    editor.save()
        .then((outputData) => {
            const contentJsonString = JSON.stringify(outputData);
            const hiddenInput = document.getElementById('editorJSContent');
            hiddenInput.value = contentJsonString;

        })
        .catch((error) => {
            console.log('Ошибка сохранения: ', error);
        });

    editorShort.save()
        .then((outputData) => {
            const contentJsonString = JSON.stringify(outputData);
            const hiddenInput = document.getElementById('EditorJSShort');
            hiddenInput.value = contentJsonString;

        })
        .catch((error) => {
            console.log('Ошибка сохранения: ', error);
        });
});


