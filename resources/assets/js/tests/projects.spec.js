import Projects from '../components/Projects.vue';
import {mount} from 'vue-test-utils';
import expect from 'expect';

describe('Projects', () => {
    var wrapper;

    beforeEach(() => {
        wrapper = mount(Projects);
    });

    it.only('hides projects list by default', () => {
        notExists('ul.projects-list')
    });

    let see = (text, selector) => {
        let wrap = selector ? wrapper.find(selector) : wrapper;

        expect(wrap.text()).toContain(text);
    };

    let notExists = selector => {
      expect(wrapper.contains(selector)).toBe(false);
    };

    let exists = selector => {
      expect(wrapper.contains(selector)).toBe(true);
    };

    let click = selector => {
      wrapper.find(selector).trigger('click');
    };

    let type = (text, selector) => {
        let node = wrapper.find(selector);

        node.element.value = text;
        node.trigger('input');

        return node;
    }
});