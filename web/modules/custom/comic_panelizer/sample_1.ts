<template>
  <div>
    <input type="file" @change="handleFileUpload">
    <div v-if="imageSrc">
      <img :src="imageSrc" @load="detectPanels">
      <div v-for="(panel, index) in panels" :key="index">
        <img :src="panel.src">
        <p>{{ panel.text }}</p>
      </div>
    </div>
  </div>
</template>

<script>
import cv from 'opencv.js';
import Tesseract from 'tesseract.js';

export default {
  data() {
    return {
      imageSrc: null,
      panels: [],
    };
  },
  methods: {
    handleFileUpload(event) {
      const file = event.target.files[0];
      this.imageSrc = URL.createObjectURL(file);
    },
    async detectPanels() {
      const img = cv.imread(this.$refs.image);
      const gray = new cv.Mat();
      cv.cvtColor(img, gray, cv.COLOR_RGBA2GRAY);
      const edges = new cv.Mat();
      cv.Canny(gray, edges, 50, 200);
      const contours = new cv.MatVector();
      const hierarchy = new cv.Mat();
      cv.findContours(edges, contours, hierarchy, cv.RETR_EXTERNAL, cv.CHAIN_APPROX_SIMPLE);
      const panels = [];
      for (let i = 0; i < contours.size(); i++) {
        const contour = contours.get(i);
        const rect = cv.boundingRect(contour);
        const panel = img.roi(rect);
        const panelDataUrl = cv.imencode('.png', panel).toString();
        const panelSrc = `data:image/png;base64,${btoa(panelDataUrl)}`;
        const panelText = await Tesseract.recognize(panelDataUrl);
        panels.push({ src: panelSrc, text: panelText.data.text });
        panel.delete();
      }
      this.panels = panels;
      img.delete();
      gray.delete();
      edges.delete();
      contours.delete();
      hierarchy.delete();
    },
  },
};
</script>
