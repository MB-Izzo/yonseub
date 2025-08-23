import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/app-layout';
import { MainLayout } from '@/layouts/main-layout';
import { type SharedData } from '@/types';
import { Textarea } from '@headlessui/react';
import { Form, Head, Link, router, usePage } from '@inertiajs/react';
import { useEffect, useRef, useState } from 'react';

type PageProps = {
    sentence?: string;
    translated?: string;
};

export default function LoggedApp() {
    const { auth } = usePage<SharedData>().props;
    const { props } = usePage<PageProps>();

    const [sentence, setSentence] = useState(props.sentence || '');
    const [translated, setTranslated] = useState(props.translated || '');
    const [showAnswer, setShowAnswer] = useState(false);

    const inputRef = useRef<HTMLInputElement>(null);

    const generateExercise = (e: React.MouseEvent<HTMLButtonElement>) => {
        e.preventDefault();
        setShowAnswer(false);
        inputRef.current.value = '';

        router.post(route('exercise.generate'), {}, {
            preserveScroll: true,
            preserveState: true,
            preserveUrl: true,
            replace: true,
            onSuccess: (page) => {
                // Update local state with the generated sentence
                if (page.props.sentence) {
                    setSentence(page.props.sentence.sentence);
                    setTranslated(page.props.sentence.translated);
                }
                console.log(page.props);
            },
            onError: (errors) => {
                console.error(errors);
            },
        });
    };

    return (
        <>
            <MainLayout title="Welcome on Yonseub!">
                <Button type="button" onClick={(e) => generateExercise(e)} className='mb-2'>Generate sentence</Button>
                {sentence ? (
                    <p className="mt-4 text-green-600 mb-4">{sentence}</p>
                ) : (
                    <p className="mt-4 text-green-600 mb-4">Generate a sentence...</p>
                )}
                <Input type='text' ref={inputRef} />
                <Button className='mt-4' onClick={() => setShowAnswer(!showAnswer)}>{!showAnswer ? 'Show answer' : 'Hide answer'}</Button>
                {showAnswer && <p className='mt-2'>{translated}</p>}
            </MainLayout>
        </>
    );
}
