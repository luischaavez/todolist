import Projects from '../components/Projects.vue';
import {mount} from 'vue-test-utils';
import expect from 'expect';
import moxios from 'moxios';

describe('Projects', () => {
    var wrapper;

    beforeEach(() => {
        moxios.install();

        wrapper = mount(Projects);
    });

    afterEach(() => {
       moxios.uninstall();
    });

    it('hides project input by default', () => {
        notExists('div.new-project-container');
    });

    it('shows input if we click the link', () => {
        click('a.show-container');

        exists('input.new-project')
    });

    it.only('allows to add new one', () => {
        click('a.show-container');

        type('Project', 'input.new-project');

        click('.add-project');

        moxios.stubRequest('/projects', {
            status: 200,
            response: {
                name: 'Project',
            }
        });

        moxios.wait(() => {
            see('Project', 'ul.projects-list');

            done();
        });
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
