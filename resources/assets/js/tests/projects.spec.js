import Projects from '../components/Projects.vue';
import {mount} from 'vue-test-utils';
import expect from 'expect';
import moxios from 'moxios';
import axios from 'axios';

describe('Projects', () => {
    var wrapper;

    beforeEach(() => {
        moxios.install();

		wrapper = mount(Projects);
	});

	afterEach(() => {
		moxios.uninstall();
	});

    it('hides projects list by default', () => {
        notExists('ul.projects-list')
    });

    it('fetch the projects list when is created', (done) => {

		moxios.stubRequest('/projects', {
			status: 200,
			response: [
				{ id: 1, name: 'Project' },
				{ id: 2, name: 'Personal' },
			]
		});

		moxios.wait(() => {
            see('Project', 'ul.projects-list');

            done();
		});

	
    });

    let see = (text, selector) => {
        let wrap = selector ? wrapper.find(selector) : wrapper;

        expect(wrap.html()).toContain(text);
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