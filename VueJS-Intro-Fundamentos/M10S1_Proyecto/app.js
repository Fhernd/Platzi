document.addEventListener('DOMContentLoaded', function() {
    const app = Vue.createApp({
        data() {
            return {
                newComparison: {
                    title: '',
                    options: [
                        { store: '', url: '', price: '', discount: false }
                    ]
                },
                comparisons: [],
                editOption: { store: '', url: '', price: '', discount: false },
                editIndices: { comparisonIndex: -1, optionIndex: -1 }
            };
        },
        created() {
            this.loadComparisons();
        },
        methods: {
            addOption() {
                this.newComparison.options.push({ store: '', url: '', price: '', discount: false });
            },
            removeOption({ comparisonIndex, optionIndex }) {
                this.comparisons[comparisonIndex].options.splice(optionIndex, 1);
                this.saveComparisons();
            },
            addComparison() {
                this.comparisons.push({ ...this.newComparison });
                this.saveComparisons();
                this.resetForm();
            },
            resetForm() {
                this.newComparison = { title: '', options: [{ store: '', url: '', price: '', discount: false }] };
            },
            saveComparisons() {
                localStorage.setItem('comparisons', JSON.stringify(this.comparisons));
            },
            loadComparisons() {
                const storedComparisons = localStorage.getItem('comparisons');
                if (storedComparisons) {
                    this.comparisons = JSON.parse(storedComparisons);
                }
            },
            exportCSV() {
                let csvContent = "data:text/csv;charset=utf-8,";
                csvContent += "Título,Tienda,URL,Precio,Descuento\n";
                this.comparisons.forEach(comparison => {
                    comparison.options.forEach(option => {
                        const discountText = option.discount ? 'Sí' : 'No';
                        csvContent += `${comparison.title},${option.store},${option.url},${option.price},${discountText}\n`;
                    });
                });
                const encodedUri = encodeURI(csvContent);
                const link = document.createElement("a");
                link.setAttribute("href", encodedUri);
                link.setAttribute("download", "comparaciones.csv");
                document.body.appendChild(link);
                link.click();
            },
            deleteComparison(index) {
                this.comparisons.splice(index, 1);
                this.saveComparisons();
            },
            openEditModal({ comparisonIndex, optionIndex }) {
                this.editIndices = { comparisonIndex, optionIndex };
                this.editOption = { ...this.comparisons[comparisonIndex].options[optionIndex] };
                new bootstrap.Modal(document.getElementById('editOptionModal')).show();
            },
            saveEdit() {
                const { comparisonIndex, optionIndex } = this.editIndices;
                this.comparisons[comparisonIndex].options[optionIndex] = { ...this.editOption };
                this.saveComparisons();
                bootstrap.Modal.getInstance(document.getElementById('editOptionModal')).hide();
            }
        }
    });

    app.component('comparison-option', {
        props: ['option', 'index'],
        template: '#comparison-option-template'
    });

    app.component('comparison', {
        props: ['comparison', 'index'],
        template: '#comparison-template',
        methods: {
            removeOption(optIndex) {
                this.$emit('remove-option', { comparisonIndex: this.index, optionIndex: optIndex });
            }
        }
    });
    
    const vm = app.mount('#app');
});
