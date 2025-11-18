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

const sets = {
    'short': {
        'tools': {
            paragraph: {
                class: Paragraph,
                inlineToolbar: true,
            },
            raw: RawTool,
            code: CodeTool,
        }
    },
    'gallery': {
        'tools': {
            gallery: {
                class: ImageGallery,
                config: {
                    sortableJs: Sortable,
                    endpoints: {
                        byFile: '/api/upload-image',
                    },
                    maxElementCount: 1000,
                },
            },
        }
    },
    'full':{
        'tools':         {
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

                            console.log('upload image');
                            const formData = new FormData();
                            formData.append('image', file);

                            return fetch('/api/upload-image', {
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
            raw: RawTool,
            attaches: {
                class: AttachesTool,
                config: {
                    endpoint: 'http://localhost:8008/uploadFile'
                }
            },
        },
        'tunes': ['backgroundTune']
    }
};

document.addEventListener('DOMContentLoaded', ()=>{

    const editors = document.querySelectorAll('.editorJS');

    editors.forEach((block) => {

        const initialData = JSON.parse(block.dataset.initialContent) ?? { blocks: [] };
        const set = sets[block.dataset.set] ?? sets['full'];

        const editor = new EditorJS({
            holder: block.id,
            data: initialData,
            placeholder: block.dataset.placeholder ?? 'Content',
            tools: set.tools,
            tunes: set.tunes,
            onChange(api, event) {
                api.saver.save()
                    .then((outputData) => {

                        const contentJsonString = JSON.stringify(outputData);
                        const hiddenInput = document.getElementById(block.dataset.for);

                        hiddenInput.value = contentJsonString;

                    })
                    .catch((error) => {
                        console.error('Ошибка сохранения:', error);
                    });
            },
        });

        editor.on('change', () => {
            const totalBlocks = editor.blocks.getBlocksCount();

            console.log(set)

            // if (totalBlocks > MAX_BLOCKS) {
            //     // Находим и удаляем последний добавленный блок по его индексу
            //     const lastIndex = totalBlocks - 1;
            //     editor.blocks.delete(lastIndex);
            //
            //     // Опционально: вывести уведомление пользователю
            //     console.warn(`Достигнут лимит в ${MAX_BLOCKS} блоков.`);
            // }
        });

    });




})
