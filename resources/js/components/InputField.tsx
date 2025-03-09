import React from 'react';

const InputField = ({ label, type, value, onChange, error }: any) => {
    return (
        <div>
            <label className="block text-sm font-medium text-gray-700 dark:text-gray-300">
                {label}
            </label>
            <input
                type={type || 'text'}
                value={value}
                onChange={onChange}
                className="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-primary focus:ring-primary sm:text-sm transition duration-150 ease-in-out"
            />
            {error && <p className="text-red-500 text-sm">{error}</p>}
        </div>
    );
};

export default InputField;