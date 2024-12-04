document.addEventListener('DOMContentLoaded', () => {
    const imgElement = document.getElementById('effect-img');
    const effectStyle = {
        effect: 'float', // Change this to 'scalezoom' for zoom effect
        width: 'auto',
        height: 'auto'
    };

    // Apply styles
    imgElement.style.width = effectStyle.width;
    imgElement.style.height = effectStyle.height;

    // Adding effect class
    imgElement.classList.add(`effect-image--${effectStyle.effect}`);

    if (effectStyle.effect === 'float') {
        const handleMouseMove = (event) => {
            const rect = imgElement.getBoundingClientRect();
            const x = ((event.clientX - rect.left) / rect.width - 0.5) * 10;
            const y = ((event.clientY - rect.top) / rect.height - 0.5) * 10;

            imgElement.style.transform = `translate(${x}px, ${y}px)`;
        };

        const resetTransform = () => {
            imgElement.style.transform = 'translate(0, 0)';
        };

        document.addEventListener('mousemove', handleMouseMove);
        document.addEventListener('mouseleave', resetTransform);

        return () => {
            document.removeEventListener('mousemove', handleMouseMove);
            document.removeEventListener('mouseleave', resetTransform);
        };
    }
});    